from flask import Flask, request, jsonify
from flask_cors import CORS
import json
import os

app = Flask(__name__)
CORS(app)

DATA_FILE = "users.json"

# Load existing users
if os.path.exists(DATA_FILE):
    with open(DATA_FILE, "r") as f:
        users = json.load(f)
else:
    users = {}

@app.route("/register", methods=["POST"])
def register():
    data = request.get_json()
    username = data.get("username")
    password = data.get("password")
    email = data.get("email")
    phone = data.get("phone") # 👈 Added phone field

    # Validate that all 4 fields are provided
    if not username or not password or not email or not phone:
        return jsonify({"success": False, "message": "Missing username, password, email, or phone"}), 400

    if username in users:
        return jsonify({"success": False, "message": "Username already exists. Please login."}), 409

    # 👈 Save the phone number into the dictionary
    users[username] = {"password": password, "email": email, "phone": phone} 
    
    with open(DATA_FILE, "w") as f:
        json.dump(users, f, indent=2)

    return jsonify({"success": True, "message": "Registered successfully!"}), 200

@app.route("/login", methods=["POST"])
def login():
    data = request.get_json()
    username = data.get("username")
    password = data.get("password")

    if username in users and users[username]["password"] == password:
        return jsonify({"success": True, "message": "Login successful!"}), 200
    else:
        return jsonify({"success": False, "message": "Invalid username or password."}), 401

if __name__ == "__main__":
    app.run(debug=False)