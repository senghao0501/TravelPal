# TravelPal Restaurants

## One-time API setup

1. Copy `config.example.php` in the project root to `config.local.php`.
2. Add a newly rotated RapidAPI key to `config.local.php`.
3. Never commit `config.local.php`; it is excluded by `.gitignore`.
4. In WAMP, confirm PHP's `curl` extension is enabled.

The browser never receives the key. It calls the PHP endpoints in `restaurant/api/`, and those endpoints call Travel Advisor by API Dojo. Successful transformed responses are cached for 15 minutes in `restaurant/cache/`.

## Pages

- `index.php` — unified restaurant landing page
- `all.php` — live restaurant results for the eight supported cities
- `detail.php` — live photos, address, opening information, menu and reviews
- `favorites.php` — separate browser-based restaurant favorites
- `food-guide.php` — preserved Malaysia dish guide
- `food-detail.php` — preserved dish details

## Database handoff

Until the user database is ready, restaurant favorites use localStorage key `travelpal_restaurant_favorites_v1`. Each saved item uses this shape:

```json
{
  "id": "restaurant contentId",
  "name": "Restaurant name",
  "image": "Photo URL",
  "rating": 4.8,
  "reviewCount": "173",
  "summary": "Price and cuisines",
  "city": "Johor Bahru",
  "state": "Johor",
  "citySlug": "johor-bahru",
  "party": 2
}
```

When My Trips is implemented, replace the localStorage read/write functions in `restaurant_app.js` with authenticated PHP endpoints. A suitable database table can store `user_id`, `restaurant_content_id`, `name`, `image_url`, `city`, `state`, `rating`, `summary`, `party_size`, and timestamps, with a unique key on `(user_id, restaurant_content_id)`.

## Local checks

Open these URLs after configuring the key:

- `/TravelPal/restaurant/index.php`
- `/TravelPal/restaurant/all.php?city=johor-bahru&party=2`
- `/TravelPal/restaurant/api/restaurant_list.php?city=johor-bahru&party=2`

The API URL should return JSON with `"ok": true`. Open any card to test the details endpoint and favorite flow.
