import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import yfinance as yf
import streamlit as st
from tensorflow.keras.models import load_model
from sklearn.preprocessing import MinMaxScaler
import datetime
import os
from dotenv import load_dotenv
import alpaca_trade_api as tradeapi

# Load Alpaca API keys
load_dotenv()
ALPACA_API_KEY = os.getenv("ALPACA_API_KEY")
ALPACA_SECRET_KEY = os.getenv("ALPACA_SECRET_KEY")

# Alpaca API (paper trading)
api = tradeapi.REST(ALPACA_API_KEY, ALPACA_SECRET_KEY, base_url='https://paper-api.alpaca.markets')

# Exchange Rate (Static)
usd_to_inr = 83.0

# Streamlit UI
st.title('📈 Stock Prediction & Trading Dashboard')

user_input = st.text_input('Enter Stock Ticker (e.g. MSFT)', 'MSFT')
in_inr = st.checkbox("Display prices in INR (₹)")
currency = "INR (₹)" if in_inr else "USD ($)"

# Date range
start = '2010-01-01'
end = datetime.date.today().strftime('%Y-%m-%d')
df = yf.download(user_input, start=start, end=end)

if df.empty:
    st.subheader('❌ No data found for the selected ticker.')
else:
    if in_inr:
        df[['Open', 'High', 'Low', 'Close', 'Volume']] *= usd_to_inr

    st.subheader(f'📊 Historical Stats ({currency})')
    st.dataframe(df.describe(), use_container_width=True)

    st.subheader('📉 Closing Price vs Time')
    fig1 = plt.figure(figsize=(10, 5))
    plt.plot(df['Close'])
    st.pyplot(fig1)

    ma100 = df['Close'].rolling(100).mean()
    ma200 = df['Close'].rolling(200).mean()

    st.subheader('📉 Closing Price with MA100 & MA200')
    fig2 = plt.figure(figsize=(10, 5))
    plt.plot(df['Close'], label='Close')
    plt.plot(ma100, 'r', label='MA100')
    plt.plot(ma200, 'g', label='MA200')
    plt.legend()
    st.pyplot(fig2)

    # Prepare Data
    data_training = pd.DataFrame(df['Close'][0:int(len(df) * 0.70)])
    data_testing = pd.DataFrame(df['Close'][int(len(df) * 0.70):])

    scaler = MinMaxScaler(feature_range=(0, 1))
    data_training_array = scaler.fit_transform(data_training)

    # Load Model
    model = load_model('keras_model.h5')

    # Test Data
    past_100_days = data_training.tail(100)
    final_df = pd.concat([past_100_days, data_testing], ignore_index=True)
    input_data = scaler.fit_transform(final_df)

    x_test = []
    y_test = []
    for i in range(100, input_data.shape[0]):
        x_test.append(input_data[i - 100:i])
        y_test.append(input_data[i, 0])

    x_test, y_test = np.array(x_test), np.array(y_test)
    y_predicted = model.predict(x_test)

    scale_factor = 1 / scaler.scale_[0]
    y_predicted *= scale_factor
    y_test *= scale_factor

    if in_inr:
        y_predicted *= usd_to_inr
        y_test *= usd_to_inr

    st.subheader(f'📈 Predicted vs Original Price ({currency})')
    fig3 = plt.figure(figsize=(10, 5))
    plt.plot(y_test, 'b', label='Original')
    plt.plot(y_predicted, 'r', label='Predicted')
    plt.xlabel('Time')
    plt.ylabel(f'Price ({currency})')
    plt.legend()
    st.pyplot(fig3)

    # Future Prediction
    st.subheader('🔮 Predicting Next 10 Days')
    last_100_days = input_data[-100:]
    predicted_prices = []
    predicted_dates = []

    for i in range(10):
        x_input = np.reshape(last_100_days, (1, last_100_days.shape[0], 1))
        predicted_price = model.predict(x_input)[0][0]
        predicted_prices.append(predicted_price)
        last_100_days = np.append(last_100_days[1:], [[predicted_price]], axis=0)
        predicted_dates.append(datetime.date.today() + datetime.timedelta(days=i+1))

    predicted_prices = np.array(predicted_prices).reshape(-1, 1)
    predicted_prices = scaler.inverse_transform(predicted_prices).flatten()

    if in_inr:
        predicted_prices *= usd_to_inr

    pred_df = pd.DataFrame({'Date': predicted_dates, f'Predicted Price ({currency})': predicted_prices})
    st.dataframe(pred_df)

    # 🚀 Buy/Sell Section
    st.subheader('💸 Buy/Sell Actions')

    col1, col2 = st.columns(2)
    symbol = user_input.upper()

    with col1:
        if st.button("Buy 1 Share"):
            api.submit_order(symbol=symbol, qty=1, side='buy', type='market', time_in_force='gtc',extended_hours=True)
            st.success(f"✅ Buy order placed for 1 share of {symbol}")

    with col2:
     if st.button("Sell 1 Share"):
        try:
            position = api.get_position(symbol)
            if int(position.qty) >= 1:
                api.submit_order(symbol=symbol, qty=1, side='sell', type='market', time_in_force='gtc')
                st.warning(f"🚩 Sell order placed for 1 share of {symbol}")
            else:
                st.error("❌ You don't own any shares to sell.")
        except tradeapi.rest.APIError:
            st.error("❌ You don't own any shares to sell.")


    st.subheader('🪙 Current Position')
    try:
        position = api.get_position(symbol)
        st.success(f"You currently hold {position.qty} shares of {symbol} at an average price of ${position.avg_entry_price}.")
    except tradeapi.rest.APIError:
        st.info("🔹 No current holdings for this stock.")

    st.subheader('📈 Portfolio Overview')
    try:
        positions = api.list_positions()
        if positions:
            df_portfolio = pd.DataFrame([{
                'Symbol': p.symbol,
                'Qty': p.qty,
                'Avg Price': p.avg_entry_price,
                'Market Value': p.market_value,
                'Unrealized P/L': p.unrealized_pl
            } for p in positions])
            st.dataframe(df_portfolio)
        else:
            st.info("🔹 You currently don't hold any positions.")
    except Exception as e:
        st.error(f"Error fetching portfolio: {e}")
    

    st.subheader('📋 Recent Orders')
    try:
        orders = api.list_orders(status='all', limit=5)
        if orders:
            df_orders = pd.DataFrame([{
                'Symbol': o.symbol,
                'Qty': o.qty,
                'Side': o.side,
                'Status': o.status,
                'Filled At': o.filled_at,
                'Submitted At': o.submitted_at
            } for o in orders])
            st.dataframe(df_orders)
        else:
            st.info("🕒 No recent orders found.")
    except Exception as e:
        st.error(f"Error fetching orders: {e}")

