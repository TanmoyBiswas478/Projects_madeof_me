import os
import json
import datetime
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import yfinance as yf
import streamlit as st

# Try importing Keras model loader (safe)
try:
    from tensorflow.keras.models import load_model
    keras_available = True
except Exception:
    keras_available = False

from sklearn.preprocessing import MinMaxScaler

# ========== CONFIG ==========
st.set_page_config(page_title="Stock Prediction & Trading Dashboard", layout="wide")

# Get user info from query params
query_params = st.query_params
username = query_params.get("user", "guest")
if isinstance(username, list):
    username = username[0]

if username == "guest":
    st.warning("⚠ No user detected! Please log in via the portal.")
    st.stop()

st.sidebar.success(f"👤 Logged in as: {username}")

# ========== PORTFOLIO HANDLING ==========
os.makedirs("portfolios", exist_ok=True)
user_portfolio_file = os.path.join("portfolios", f"{username}.json")

if not os.path.exists(user_portfolio_file):
    with open(user_portfolio_file, "w") as f:
        json.dump({"positions": {}, "orders": []}, f, indent=2)

def load_portfolio():
    with open(user_portfolio_file, "r") as f:
        return json.load(f)

def save_portfolio(data):
    with open(user_portfolio_file, "w") as f:
        json.dump(data, f, indent=2)

portfolio = load_portfolio()

# ========== UI ==========
st.title("📈 Stock Prediction & Trading Dashboard")
user_input = st.text_input("Enter Stock Ticker (e.g. MSFT, AAPL, RELIANCE.NS)", "RELIANCE.NS").upper().strip()

in_inr = st.checkbox("Display prices in INR (₹)")
usd_to_inr = 83.0
currency = "INR (₹)" if in_inr else "USD ($)"

end = datetime.date.today()
start = end - datetime.timedelta(days=365 * 3)  # last 3 years

# ========== DATA FETCH SECTION ==========
df = pd.DataFrame()
try:
    if user_input:
        # Try download from yfinance
        df = yf.download(
            user_input,
            start=start.strftime("%Y-%m-%d"),
            end=(end + datetime.timedelta(days=1)).strftime("%Y-%m-%d"),
            progress=False,
            threads=False
        )

        # Fallback 1: use Ticker.history()
        if df.empty:
            ticker = yf.Ticker(user_input)
            df = ticker.history(start=start, end=end + datetime.timedelta(days=1), interval="1d")

        # Fallback 2: try NSE suffix automatically
        if df.empty and not user_input.endswith(".NS"):
            ticker = yf.Ticker(user_input + ".NS")
            df = ticker.history(start=start, end=end + datetime.timedelta(days=1), interval="1d")

except Exception as e:
    st.error(f"❌ Error fetching data: {e}")
    st.stop()

if df is None or df.empty:
    st.subheader("❌ No data found for the selected ticker. Try another one (e.g. MSFT, AAPL, RELIANCE.NS).")
    st.stop()

# Convert index to datetime if needed
if not isinstance(df.index, pd.DatetimeIndex):
    df.index = pd.to_datetime(df.index)

# Convert to INR if checked
if in_inr:
    df[['Open', 'High', 'Low', 'Close', 'Volume']] = df[['Open', 'High', 'Low', 'Close', 'Volume']].apply(lambda x: x * usd_to_inr)

# ========== DISPLAY STATS ==========
st.subheader(f"📊 Historical Stats ({currency})")
st.dataframe(df.describe(), use_container_width=True)

# ========== PLOTS ==========
st.subheader("📉 Closing Price vs Time")
fig1 = plt.figure(figsize=(10, 4))
plt.plot(df['Close'])
plt.title(f"{user_input} Closing Price")
plt.grid(True)
st.pyplot(fig1)

ma100 = df['Close'].rolling(100).mean()
ma200 = df['Close'].rolling(200).mean()

st.subheader("📉 Closing Price with MA100 & MA200")
fig2 = plt.figure(figsize=(10, 4))
plt.plot(df['Close'], label='Close')
plt.plot(ma100, 'r', label='MA100')
plt.plot(ma200, 'g', label='MA200')
plt.legend()
plt.grid(True)
st.pyplot(fig2)

# ========== MODEL LOADING ==========
model = None
if keras_available:
    try:
        if os.path.exists("keras_model.h5"):
            model = load_model("keras_model.h5")
        else:
            st.info("No keras_model.h5 found — prediction features disabled.")
    except Exception as e:
        st.warning(f"Could not load Keras model: {e}")
        model = None
else:
    st.info("TensorFlow/Keras not available — skipping model predictions.")

# ========== DATA PREPARATION ==========
scaler = MinMaxScaler(feature_range=(0, 1))
input_data = None
if model is not None:
    try:
        data_training = pd.DataFrame(df['Close'][0:int(len(df) * 0.70)])
        data_testing = pd.DataFrame(df['Close'][int(len(df) * 0.70):])
        scaler.fit(data_training)

        past_100_days = data_training.tail(100)
        final_df = pd.concat([past_100_days, data_testing], ignore_index=True)
        input_data = scaler.transform(final_df)

        x_test, y_test = [], []
        for i in range(100, input_data.shape[0]):
            x_test.append(input_data[i - 100:i])
            y_test.append(input_data[i, 0])

        x_test, y_test = np.array(x_test), np.array(y_test)

        if x_test.size == 0:
            st.info("Not enough data for model prediction.")
            model = None
    except Exception as e:
        st.warning(f"Data prep error: {e}")
        model = None

# ========== PREDICTION ==========
if model is not None and 'x_test' in locals() and x_test.size != 0:
    try:
        y_predicted = model.predict(x_test)
        y_predicted_inv = scaler.inverse_transform(y_predicted.reshape(-1, 1)).flatten()
        y_test_inv = scaler.inverse_transform(y_test.reshape(-1, 1)).flatten()

        if in_inr:
            y_predicted_inv *= usd_to_inr
            y_test_inv *= usd_to_inr

        st.subheader(f"📈 Predicted vs Original Price ({currency})")
        fig3 = plt.figure(figsize=(10, 4))
        plt.plot(y_test_inv, 'b', label='Original')
        plt.plot(y_predicted_inv, 'r', label='Predicted')
        plt.xlabel('Time')
        plt.ylabel(f'Price ({currency})')
        plt.legend()
        plt.grid(True)
        st.pyplot(fig3)
    except Exception as e:
        st.warning(f"Prediction error: {e}")

# ========== NEXT 10-DAY FORECAST ==========
if model is not None and input_data is not None:
    try:
        st.subheader("🔮 Next 10-Day Price Forecast")
        last_100_days = input_data[-100:]
        predicted_prices = []
        predicted_dates = []

        for i in range(10):
            x_input = np.reshape(last_100_days, (1, last_100_days.shape[0], 1))
            predicted_price = model.predict(x_input)[0][0]
            predicted_prices.append(predicted_price)
            last_100_days = np.append(last_100_days[1:], [[predicted_price]], axis=0)
            predicted_dates.append(datetime.date.today() + datetime.timedelta(days=i + 1))

        predicted_prices = np.array(predicted_prices).reshape(-1, 1)
        predicted_prices = scaler.inverse_transform(predicted_prices).flatten()

        if in_inr:
            predicted_prices *= usd_to_inr

        pred_df = pd.DataFrame({'Date': predicted_dates, f'Predicted Price ({currency})': predicted_prices})
        st.dataframe(pred_df)
    except Exception as e:
        st.warning(f"Forecast error: {e}")

# ========== BUY / SELL ==========
st.subheader("💸 Buy / Sell Actions")
col1, col2 = st.columns(2)
symbol = user_input.upper()
portfolio = load_portfolio()

if col1.button("Buy 1 Share"):
    try:
        price = float(df['Close'].iloc[-1])
        if in_inr:
            price *= usd_to_inr
        portfolio["positions"][symbol] = portfolio["positions"].get(symbol, 0) + 1
        portfolio["orders"].append({
            "symbol": symbol,
            "side": "buy",
            "qty": 1,
            "price": price,
            "time": str(datetime.datetime.now())
        })
        save_portfolio(portfolio)
        st.success(f"✅ Bought 1 share of {symbol} at {currency} {price:.2f}")
    except Exception as e:
        st.error(f"Buy failed: {e}")

if col2.button("Sell 1 Share"):
    try:
        if portfolio["positions"].get(symbol, 0) > 0:
            price = float(df['Close'].iloc[-1])
            if in_inr:
                price *= usd_to_inr
            portfolio["positions"][symbol] -= 1
            portfolio["orders"].append({
                "symbol": symbol,
                "side": "sell",
                "qty": 1,
                "price": price,
                "time": str(datetime.datetime.now())
            })
            save_portfolio(portfolio)
            st.warning(f"🚩 Sold 1 share of {symbol} at {currency} {price:.2f}")
        else:
            st.error("❌ No shares to sell.")
    except Exception as e:
        st.error(f"Sell failed: {e}")

# ========== PORTFOLIO DISPLAY ==========
st.subheader("🪙 Current Portfolio")
portfolio = load_portfolio()
positions = [{"Symbol": s, "Qty": q} for s, q in portfolio["positions"].items() if q > 0]

if positions:
    st.dataframe(pd.DataFrame(positions))
else:
    st.info("No holdings yet.")

st.subheader("📋 Recent Orders")
orders = portfolio.get("orders", [])

if orders:
    orders_df = pd.DataFrame(orders[-10:])  # show last 10 only
    st.dataframe(orders_df)
else:
    st.info("No recent orders for this user.")

# ========== LOGOUT ==========
if st.sidebar.button("🚪 Logout"):
    st.success("Logging out... Redirecting to login page...")

    # Clear Streamlit session state
    for k in list(st.session_state.keys()):
        del st.session_state[k]

    # JS redirect using Markdown (this works reliably)
    st.markdown("""
        <meta http-equiv="refresh" content="1; url=http://127.0.0.1:5500/index.html">
        <p>Redirecting to login page...</p>
    """, unsafe_allow_html=True)

