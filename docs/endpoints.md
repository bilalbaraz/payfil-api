# API Endpoints

This document provides an overview of the API endpoints, detailing their purpose, HTTP methods, required parameters, and example responses.

## Base URL

All requests should be made to the following base URL:

```bash
http://localhost/api
```

## Endpoints

### 1. **Create Token**

**Endpoint:** `/tokens/create`  
**Method:** `POST`

**Request Parameters:**

| Parameter  | Type     | Required | Description                        |
|------------|----------|----------|------------------------------------|
| `email`    | `string` | Yes      | The email address of the user. Must be a valid email format. |
| `password` | `string` | Yes      | The password of the user. Should meet security requirements (e.g., minimum length, complexity). |

### 1. **Get Orders**

**Endpoint:** `/orders`  
**Method:** `GET`

**Request Parameters:**

| Parameter            | Type      | Required | Description                                                                                   |
|----------------------|-----------|----------|-----------------------------------------------------------------------------------------------|
| `payment_provider_ids`| `array`  | No      | An array of IDs corresponding to the payment providers to be used in the transaction.         |
| `starts_at`          | `datetime`| No      | The start date and time for the request (e.g., filtering data from this point in time).       |
| `ends_at`            | `datetime`| No      | The end date and time for the request (e.g., filtering data up to this point in time).        |
| `currencies`         | `array`   | No       | An array of currency codes (e.g., ['USD', 'EUR', 'TRY']) that are applicable for the request.         |

### 1. **Checkout Order**

**Endpoint:** `/orders/checkout`  
**Method:** `POST`

**Request Parameters:**

| Parameter          | Type      | Required | Description                                                        |
|--------------------|-----------|----------|--------------------------------------------------------------------|
| `payment_provider_id` | `integer` | Yes      | The ID of the payment provider used for the transaction.           |
| `product_id`       | `string`  | Yes      | The ID of the product being purchased.                             |
| `quantity`         | `integer` | Yes      | The quantity of the product to be ordered.                         |
| `expire_month`     | `integer` | Yes      | The expiration month of the credit card (1-12).                    |
| `expire_year`      | `integer` | Yes      | The expiration year of the credit card.                            |
| `card_number`      | `string`  | Yes      | The credit card number. Must pass Luhn algorithm validation.       |
| `cvc`              | `string`  | Yes      | The CVC code (Card Verification Code) on the credit card.          |
| `card_holdername`  | `string`  | Yes      | The name of the cardholder as it appears on the credit card.       |
| `installment`      | `integer` | Yes      | The number of installments for payment. `1` for a single payment. Valids 1, 2, 3, 6, 9, 12.  |
| `shipping_address` | `string`  | Yes      | The address where the order will be shipped.                       |
| `billing_address`  | `string`  | Yes      | The address associated with the payment method.                    |
