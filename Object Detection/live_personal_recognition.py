"""
live_personal_recognition.py
Robust live personalized recognition (webcam or IP camera).

Controls (while the OpenCV window is focused):
 t - toggle TRAINING (auto-capture)
 c - capture one example manually
 d - toggle DETECTION
 s - save features to disk
 l - load features from disk
 r - reset/clear features
 u - change username (type in console)
 q - quit

Dependencies:
 pip install tensorflow==2.12.0 opencv-python numpy scikit-learn
(Use numpy 1.23.x with TF 2.12)
"""

import os
import sys
import time
import threading
import numpy as np
import cv2
from sklearn.metrics.pairwise import cosine_similarity

# Attempt imports
try:
    from tensorflow.keras.applications import MobileNetV2
    from tensorflow.keras.preprocessing import image as keras_image
    from tensorflow.keras.applications.mobilenet_v2 import preprocess_input
except Exception as ex:
    print("ERROR: TensorFlow/Keras import failed. Install dependencies:")
    print("  pip install tensorflow opencv-python numpy scikit-learn")
    raise ex

# ----------------- CONFIG -----------------
IMAGE_SIZE = (224, 224)
FEATURE_VECTOR_SIZE = 1280
POOLING = "avg"
USER_DATA_DIR = "user_data"
os.makedirs(USER_DATA_DIR, exist_ok=True)

# Detection hyperparameters (tune these)
CONFIDENCE_THRESHOLD = 0.82   # treat score >= this as a match
MIN_TRAIN_SAMPLES = 8         # require at least this many samples before detection
AUTO_CAPTURE_INTERVAL = 0.8   # seconds between auto-captures in training
TOP_N = 3                     # use top-N similarities for averaging
SCORE_SMOOTH_ALPHA = 0.4      # smoothing factor for displayed score (0-1)

# ----------------- MODEL -----------------
print("Loading MobileNetV2 (ImageNet weights). This may take a moment...")
_model = MobileNetV2(weights="imagenet", include_top=False, pooling=POOLING)
print("Model loaded.\n")

# ----------------- HELPERS -----------------
def l2_normalize(v: np.ndarray) -> np.ndarray:
    n = np.linalg.norm(v)
    return v / n if n > 0 else v

def extract_features_from_frame(frame):
    """Return L2-normalized 1D feature vector for a BGR OpenCV frame."""
    img_rgb = cv2.cvtColor(frame, cv2.COLOR_BGR2RGB)
    img_resized = cv2.resize(img_rgb, IMAGE_SIZE)
    x = keras_image.img_to_array(img_resized)
    x = np.expand_dims(x, axis=0)
    x = preprocess_input(x)
    feats = _model.predict(x, verbose=0).flatten()
    return l2_normalize(feats)

def compute_similarity_score(feature, feature_set, top_n=TOP_N):
    """
    Compute a combined similarity score using:
      - mean of top-N similarities
      - centroid similarity
      - mean similarity
    Returns a float in [0,1]. If feature_set empty returns 0.0.
    """
    if not feature_set:
        return 0.0
    arr = np.vstack(feature_set)  # (N, D)
    sims = cosine_similarity(feature.reshape(1, -1), arr)[0]  # (N,)
    # top-N mean
    top_scores = np.sort(sims)[::-1][:max(1, min(top_n, len(sims)))]
    top_mean = float(np.mean(top_scores))
    mean_sim = float(np.mean(sims))
    centroid = l2_normalize(np.mean(arr, axis=0))
    centroid_sim = float(cosine_similarity(feature.reshape(1, -1), centroid.reshape(1, -1))[0][0])
    # Weighted combination (experimentally tuned)
    score = 0.5 * top_mean + 0.3 * centroid_sim + 0.2 * mean_sim
    return float(np.clip(score, 0.0, 1.0))

# ----------------- PERSISTENCE -----------------
def save_user_features(username, features_list):
    if not username:
        print("⚠️ Username required to save.")
        return
    fname = os.path.join(USER_DATA_DIR, f"{username}_features.npz")
    if not features_list:
        np.savez_compressed(fname, features=np.zeros((0, FEATURE_VECTOR_SIZE)))
    else:
        arr = np.vstack([l2_normalize(v) for v in features_list])
        np.savez_compressed(fname, features=arr)
    print(f"💾 Saved {len(features_list)} feature vectors -> {fname}")

def load_user_features(username):
    fname = os.path.join(USER_DATA_DIR, f"{username}_features.npz")
    if not os.path.exists(fname):
        print(f"⚠️ No saved features for '{username}'.")
        return []
    data = np.load(fname)
    feats = [l2_normalize(v) for v in data["features"] if np.linalg.norm(v) > 0]
    print(f"📂 Loaded {len(feats)} features from {fname}")
    return feats

# ----------------- GLOBAL STATE -----------------
state = {
    "username": "default_user",
    "features": [],          # list of normalized vectors
    "training": False,
    "detection": False,
    "auto_capture_interval": AUTO_CAPTURE_INTERVAL,
}

auto_capture_stop = threading.Event()
auto_capture_thread = None

# keep smoothed score for display to reduce flicker
_smoothed_score = 0.0

# ----------------- AUTO CAPTURE WORKER -----------------
def auto_capture_worker(get_frame_fn):
    print("🔴 Auto-capture thread started.")
    while not auto_capture_stop.is_set():
        if state["training"]:
            frame = get_frame_fn()
            if frame is not None:
                try:
                    f = extract_features_from_frame(frame)
                    state["features"].append(f)
                    print(f"📸 Auto-captured #{len(state['features'])}")
                except Exception as e:
                    print("Auto-capture: feature extraction failed:", e)
        time.sleep(state["auto_capture_interval"])
    print("🔺 Auto-capture thread stopping.")

# ----------------- DRAW UI -----------------
def draw_meter_on_frame(frame, score, mode_text, username):
    global _smoothed_score
    h, w = frame.shape[:2]
    # smoothing
    _smoothed_score = SCORE_SMOOTH_ALPHA * score + (1 - SCORE_SMOOTH_ALPHA) * _smoothed_score

    cv2.putText(frame, f"User: {username}", (10, 22), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255,255,255), 2)
    cv2.putText(frame, f"Mode: {mode_text}", (10, 46), cv2.FONT_HERSHEY_SIMPLEX, 0.6, (255,255,255), 2)

    # If not enough samples and detection mode, show info
    if len(state["features"]) < MIN_TRAIN_SAMPLES and mode_text == "DETECT":
        cv2.putText(frame, f"Need {MIN_TRAIN_SAMPLES} samples to detect (have {len(state['features'])})",
                    (10, 78), cv2.FONT_HERSHEY_SIMPLEX, 0.55, (0,140,255), 2)
        display_score = 0.0
        color = (0, 0, 255)
    else:
        display_score = _smoothed_score
        color = (0,255,0) if display_score >= CONFIDENCE_THRESHOLD else (0,0,255)

    perc = int(display_score * 100)
    cv2.putText(frame, f"Match: {perc}%", (10, 110), cv2.FONT_HERSHEY_SIMPLEX, 0.8, color, 2)

    meter_w = int(w * 0.45)
    x0, y0 = 10, h - 44
    cv2.rectangle(frame, (x0, y0), (x0 + meter_w, y0 + 20), (50,50,50), -1)
    fill_w = int(meter_w * np.clip(display_score, 0.0, 1.0))
    cv2.rectangle(frame, (x0, y0), (x0 + fill_w, y0 + 20), color, -1)
    cv2.rectangle(frame, (x0, y0), (x0 + meter_w, y0 + 20), (200,200,200), 1)
    cv2.putText(frame, f"Examples: {len(state['features'])}", (x0 + meter_w + 12, y0 + 16),
                cv2.FONT_HERSHEY_SIMPLEX, 0.55, (255,255,255), 1)

# ----------------- CAMERA LOOP -----------------
def run_camera_loop(source=0):
    global auto_capture_thread, auto_capture_stop, _smoothed_score

    # Accept string (IP) or int (index)
    print(f"Opening camera source: {source}")
    cap = cv2.VideoCapture(source)

    if not cap.isOpened():
        print("ERROR: Could not open camera source. If using IP camera, ensure URL ends with /video and phone+PC are on same network.")
        return

    latest = {"frame": None}
    def get_latest_frame():
        return latest["frame"]

    # start auto-capture thread
    auto_capture_stop.clear()
    auto_capture_thread = threading.Thread(target=auto_capture_worker, args=(get_latest_frame,))
    auto_capture_thread.daemon = True
    auto_capture_thread.start()

    print("Camera started. Controls: t=train c=capture d=detect s=save l=load r=reset u=user q=quit")
    last_debug = time.time()
    _smoothed_score = 0.0

    try:
        while True:
            ret, frame = cap.read()
            if not ret or frame is None:
                # retry loop instead of breaking (handles IP camera hiccups)
                time.sleep(0.2)
                continue

            latest["frame"] = frame.copy()

            mode = "IDLE"
            score = 0.0

            if state["detection"]:
                mode = "DETECT"
                if len(state["features"]) >= MIN_TRAIN_SAMPLES:
                    try:
                        f = extract_features_from_frame(frame)
                        score = compute_similarity_score(f, state["features"])
                    except Exception as e:
                        print("Error extracting features during detection:", e)
                        score = 0.0
                else:
                    score = 0.0

            elif state["training"]:
                mode = "TRAINING"
                # optional similarity display during training
                try:
                    f = extract_features_from_frame(frame)
                    score = compute_similarity_score(f, state["features"]) if state["features"] else 0.0
                except Exception:
                    score = 0.0
                # actual capture handled by auto-capture thread or manual 'c'

            draw_meter_on_frame(frame, score, mode, state["username"])
            cv2.imshow("Live Personalized Recognition", frame)

            # occasional debug print
            if time.time() - last_debug > 4:
                print(f"[DEBUG] username={state['username']} samples={len(state['features'])} training={state['training']} detection={state['detection']}")
                last_debug = time.time()

            key = cv2.waitKey(1) & 0xFF
            if key == ord("q"):
                break
            elif key == ord("t"):
                state["training"] = not state["training"]
                print("Training ->", state["training"])
            elif key == ord("d"):
                state["detection"] = not state["detection"]
                print("Detection ->", state["detection"])
            elif key == ord("c"):
                # manual capture
                try:
                    f = extract_features_from_frame(frame)
                    state["features"].append(f)
                    print(f"Manual capture #{len(state['features'])}")
                except Exception as e:
                    print("Manual capture failed:", e)
            elif key == ord("s"):
                save_user_features(state["username"], state["features"])
            elif key == ord("l"):
                state["features"] = load_user_features(state["username"])
            elif key == ord("r"):
                state["features"] = []
                print("Cleared stored features.")
            elif key == ord("u"):
                # read username from console
                print("Enter new username (press Enter): ", end="", flush=True)
                newname = sys.stdin.readline().strip()
                if newname:
                    state["username"] = newname
                    print("Username set to:", newname)
                else:
                    print("Username unchanged.")
    finally:
        auto_capture_stop.set()
        if auto_capture_thread is not None:
            auto_capture_thread.join(timeout=2.0)
        cap.release()
        cv2.destroyAllWindows()
        print("Program terminated.")

# ----------------- ENTRY -----------------
if __name__ == "__main__":
    # By default use laptop webcam:
    # run_camera_loop(0)

    # If you want to use your phone IP stream, replace below with your IP stream URL:
    # example: "http://192.168.0.101:4747/video"
    # NOTE: ensure phone+PC on same Wi-Fi and the app provides /video endpoint.
    run_camera_loop(0)
