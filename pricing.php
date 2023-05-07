<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="pricing.css">
  <title>Pricing</title>
  <script src="https://js.stripe.com/v3/"></script>
  <style>
    body {
  font-family: Arial, sans-serif;
  background-color: #1a1a1a;
  color: #FFFFFF;
  margin: 0;
  padding: 0;
}

header {
  background-color: #333333;
  padding: 20px 0;
  text-align: center;
  width: 100%;
}

h1 {
  font-size: 2.5em;
  color: #9c27b0;
  margin-bottom: 30px;
}

.pricing-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin: 0 auto;
  max-width: 1200px;
  padding: 20px;
}

.pricing-card {
  background-color: #333333;
  border-radius: 5px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  text-align: center;
  width: 300px;
}

.pricing-card h2 {
  font-size: 1.75em;
  margin-bottom: 10px;
}

.pricing-card h3 {
  font-size: 1.5em;
  margin-bottom: 20px;
}

.pricing-card ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.pricing-card li {
  margin-bottom: 10px;
}

button {
  background-color: #9c27b0;
  border: none;
  border-radius: 5px;
  color: #FFFFFF;
  cursor: pointer;
font-size: 1em;
padding: 10px 20px;
text-transform: uppercase;
transition: background-color 0.3s;
}

button:hover {
background-color: #7b1fa2;
}

@media (max-width: 768px) {
.pricing-container {
flex-direction: column;
}

.pricing-card {
margin: 20px auto;
}
}
  </style>
</head>
<body>
  <header>
    <h1>Pricing Plans</h1>
  </header>
  <main>
    <div class="pricing-container">
      
      <div class="pricing-card">
        <h2>Basic</h2>
        <h3>2.90 EUR/month</h3>
        <ul>
        <li>Everything in the Free plan</li>
          <li>300 messages per month for GPT 3.5</li>
          <li>50 messages per month for GPT 4</li>
          <li>Email support</li>
        </ul>
        <button id="basic_checkout_button">Get Started</button>
        <script>
        const publicKey = 'pk_live_51N4KymKy2Ki2xcvjfsANuH6axZwW7Z6rezNpcYMGA35ptwrHC88WomjnOqZzQEXQ4OwBN3kxePeLiMnU17b5wLql00Mt2lSPuj'; // Replace with your publishable key
        const stripe = Stripe(publicKey);

        document.getElementById('basic_checkout_button').addEventListener('click', () => {
            fetch('basic_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>
      <div class="pricing-card">
        <h2>Pro</h2>
        <h3>15 BGN/month</h3>
        <ul>
        <li>Everything in the Basic plan</li>
        <li>Unlimited messages for GPT 3.5</li>
        <li>300 messages per month for GPT 4</li>
        <li>Human text generator - 50 generated texts per month</li>
        <li>ALLIN math solver - 50 solved problems per month</li>
        <li>ALLIN translator - 100 translations per month</li>
        <li>Phone support</li>
        </ul>
        <button id="pro_checkout_button">Get Started</button>
        <script>
        document.getElementById('pro_checkout_button').addEventListener('click', () => {
            fetch('pro_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>
      <div class="pricing-card">
        <h2>Premium</h2>
        <h3>35 BGN/month</h3>
        <ul>
        <li>Everything in the Pro plan</li>
        <li>Unlimited messages for GPT 4</li>
        <li>Human text generator - unlimited generated texts per month</li>
        <li>ALLIN math solver - unlimited solved problems per month</li>
        <li>ALLIN translator - unlimited translations per month</li>
        <li>Urgent phone support</li>
        </ul>
        <button id="premium_checkout_button">Get Started</button>
        <script>
        document.getElementById('premium_checkout_button').addEventListener('click', () => {
            fetch('premium_checkout.php', {
                method: 'POST',
            })
            .then(response => response.json())
            .then(session => {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(result => {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
      </div>

      <div class="pricing-card">
        <h2>Free (GPT 3.5)</h2>
        <h3>$0</h3>
        <ul>
        <li>Just GPT 3.5 avivable</li>
          <li>50 messages per month for GPT 3.5</li>
          <li>No high demand. Always the fastest response.</li>
          <li>No technical support</li>
        </ul>
        <button>Get Started</button>
      </div>
    </div>
  </main>
</body>
</html>
