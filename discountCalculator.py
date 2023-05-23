from flask import Flask

app = Flask(__name__)

@app.route("/api/discountCalculator/<discount>")
def calculat(discount):
    discount = int(discount)

    if discount >= 10000:
        discount = discount*(1-0.12)

    elif discount >= 5000:
        discount = discount*(1-0.08)

    elif discount >= 3000:
        discount = discount*(1-0.03)

    respose_date={"discount": discount}

    return respose_date


if __name__ == "__main__":
    app.run(debug = True,
    host='127.0.0.1',
    port=8080)
