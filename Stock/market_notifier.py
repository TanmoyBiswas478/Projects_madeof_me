import smtplib
from email.mime.text import MIMEText
from datetime import datetime, timedelta
import json, time, os, yfinance as yf
import pandas as pd
from twilio.rest import Client

# =========================
# 🔑 TWILIO CREDENTIALS
# =========================
TWILIO_SID = "AC805b4efc29971ea7ee85bc9000a9f827"
TWILIO_TOKEN = "a9540c11d57583291fb5610a9062d64b"
TWILIO_WHATSAPP_NUMBER = "whatsapp:+14155238886"  # Twilio Sandbox Number

# =========================
# 📱 WHATSAPP SENDER FUNCTION
# =========================
def send_whatsapp(to_phone, message):
    if not to_phone:
        return
    try:
        client = Client(TWILIO_SID, TWILIO_TOKEN)
        msg = client.messages.create(
            from_=TWILIO_WHATSAPP_NUMBER,
            body=message,
            to=f"whatsapp:{to_phone}"
        )
        print(f"✅ WhatsApp sent to {to_phone}")
    except Exception as e:
        print(f"❌ Failed to send WhatsApp to {to_phone}: {e}")

# =========================
# ✉️ EMAIL SENDER FUNCTION
# =========================
def send_email(to_email, subject, message):
    sender = "tanmoybiswas478@gmail.com"
    password = "dlmn shsd vrpm lwcu"  

    msg = MIMEText(message, "plain")
    msg["Subject"] = subject
    msg["From"] = sender
    msg["To"] = to_email

    try:
        with smtplib.SMTP_SSL("smtp.gmail.com", 465) as server:
            server.login(sender, password)
            server.send_message(msg)
        print(f"✅ Email sent to {to_email}")
    except Exception as e:
        print(f"❌ Failed to send email to {to_email}: {e}")

# =========================
# 💱 GET USD→INR CONVERSION
# =========================
def get_usd_inr_rate():
    try:
        data = yf.download("USDINR=X", period="1d", interval="1d")
        if not data.empty:
            rate = float(data["Close"].iloc[-1])
            return round(rate, 2)
        else:
            return 83.0
    except Exception as e:
        print(f"⚠️ Failed to fetch USD→INR rate: {e}")
        return 83.0

# =========================
# 📂 LOAD USERS
# =========================
def load_users():
    if not os.path.exists("users.json"):
        print("⚠️ No users.json file found.")
        return {}
    with open("users.json", "r") as f:
        return json.load(f)

# =========================
# 💼 LOAD USER PORTFOLIO
# =========================
def load_portfolio(username):
    file_path = f"portfolios/{username}.json"
    if not os.path.exists(file_path):
        return {"positions": {}}
    with open(file_path, "r") as f:
        return json.load(f)

# =========================
# 📈 FETCH STOCK PRICES
# =========================
def get_stock_prices(symbol):
    today = datetime.now().date()
    start_date = today - timedelta(days=7)
    try:
        data = yf.download(symbol, start=start_date, end=today + timedelta(days=1))
        if data.empty:
            return None, None, None

        def safe_val(val):
            if isinstance(val, pd.Series):
                val = val.iloc[0]
            return round(float(val), 2) if pd.notna(val) else None

        if len(data) >= 2:
            yesterday_close = safe_val(data["Close"].iloc[-2])
        else:
            yesterday_close = None

        today_open = safe_val(data["Open"].iloc[-1])
        today_close = safe_val(data["Close"].iloc[-1])

        return yesterday_close, today_open, today_close
    except Exception as e:
        print(f"❌ Error fetching data for {symbol}: {e}")
        return None, None, None

# =========================
# 🕒 MAIN LOOP
# =========================
def main():
    sent_open = False
    sent_close = False

    print("📬 Market Notifier is running... waiting for time match.")

    while True:
        now = datetime.now().strftime("%H:%M")
        users = load_users()
        usd_inr = get_usd_inr_rate()

        # ========== MARKET OPEN ==========
        if now == "19:59" and not sent_open:
            print(f"⏰ {now} - Sending market open alerts...")

            for username, info in users.items():
                email = info.get("email")
                phone = info.get("phone")

                if not email and not phone:
                    print(f"⚠️ Skipping '{username}' — no contact info found.")
                    continue

                portfolio = load_portfolio(username)
                positions = portfolio.get("positions", {})

                greeting = (
                    f"🌅 Good Morning {username}!\n\n"
                    "📊 Welcome to a brand new trading day!\n"
                    "Stay confident, trade smart, and let’s make your portfolio shine.\n"
                    "-------------------------------------------------------------\n\n"
                )

                if not positions:
                    body = greeting + "📈 The market is now open! You currently have no active holdings."
                else:
                    body = greeting + "Here’s your portfolio summary:\n\n"
                    total_net_worth_usd = 0.0

                    for symbol, qty in positions.items():
                        y_close, t_open, _ = get_stock_prices(symbol)
                        y_close_inr = round(y_close * usd_inr, 2) if y_close else "N/A"
                        t_open_inr = round(t_open * usd_inr, 2) if t_open else "N/A"

                        holding_value_usd = (t_open * qty) if t_open else 0
                        holding_value_inr = holding_value_usd * usd_inr
                        total_net_worth_usd += holding_value_usd

                        body += f"🏛️ *{symbol}* ({qty} shares):\n"
                        body += f"   • Yesterday’s Close: ₹{y_close_inr}  (${y_close or 'N/A'})\n"
                        body += f"   • Today's Open: ₹{t_open_inr}  (${t_open or 'N/A'})\n"
                        body += f"   • Holding Value: ₹{round(holding_value_inr, 2)}  (${round(holding_value_usd, 2)})\n\n"

                    total_net_worth_inr = round(total_net_worth_usd * usd_inr, 2)
                    body += "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    body += f"🪙 *TOTAL NET WORTH: ₹{total_net_worth_inr}*  (${round(total_net_worth_usd, 2)})\n"
                    body += "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    body += "🧠 _Powered by LSTM Predictive Analytics_\n"

                if email:
                    send_email(email, "🌅 Market Open - Daily Portfolio Update", body)
                if phone:
                    send_whatsapp(phone, body)

            sent_open = True
            sent_close = False

        # ========== MARKET CLOSE ==========
        elif now == "20:01" and not sent_close:
            print(f"⏰ {now} - Sending market close alerts...")

            for username, info in users.items():
                email = info.get("email")
                phone = info.get("phone")

                if not email and not phone:
                    continue

                portfolio = load_portfolio(username)
                positions = portfolio.get("positions", {})

                greeting = (
                    f"🌇 Good Evening {username}!\n\n"
                    "🕔 The trading session has come to an end.\n"
                    "Take a moment to reflect on today’s performance and plan ahead for tomorrow.\n"
                    "-------------------------------------------------------------\n\n"
                )

                if not positions:
                    body = greeting + "🔒 The market has closed. You currently have no holdings."
                else:
                    body = greeting + "Here are your closing stock values:\n\n"
                    total_net_worth_usd = 0.0

                    for symbol, qty in positions.items():
                        _, _, t_close = get_stock_prices(symbol)
                        t_close_inr = round(t_close * usd_inr, 2) if t_close else "N/A"

                        holding_value_usd = (t_close * qty) if t_close else 0
                        holding_value_inr = holding_value_usd * usd_inr
                        total_net_worth_usd += holding_value_usd

                        body += f"🏛️ *{symbol}* ({qty} shares):\n"
                        body += f"   • Today's Close: ₹{t_close_inr}  (${t_close or 'N/A'})\n"
                        body += f"   • Holding Value: ₹{round(holding_value_inr, 2)}  (${round(holding_value_usd, 2)})\n\n"

                    total_net_worth_inr = round(total_net_worth_usd * usd_inr, 2)
                    body += "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    body += f"🪙 *TOTAL NET WORTH: ₹{total_net_worth_inr}*  (${round(total_net_worth_usd, 2)})\n"
                    body += "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n"
                    body += "🧠 _Powered by LSTM Predictive Analytics_\n"

                if email:
                    send_email(email, "🌇 Market Closed - Day Summary", body)
                if phone:
                    send_whatsapp(phone, body)

            sent_close = True
            sent_open = False

        time.sleep(5)

if __name__ == "__main__":
    main()