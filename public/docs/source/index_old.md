---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# INTRODUCTION

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)
<!-- END_INFO -->

#Admin Controller

By accessing the endpoints on this API you can 
- Access the admin dashboard 
- Create/Update/Delete Events/Tradeshows
- Create/Update/Delete Photo/Video Ads
- Upload/Delete Gallery Images
<!-- START_4d12119dce26b7df4c0c737c5de8f208 -->
## Admin Dashboard

Admin Dashboard(Landing page).

> Example request:

```bash
curl -X GET "http://localhost/home" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/home",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET home`

`HEAD home`


<!-- END_4d12119dce26b7df4c0c737c5de8f208 -->

<!-- START_70b38920b4ad2d0327e6a90b14cdb244 -->
## Admin Events

Returns a Page containing <strong><u>all</u></strong> published(enabled) events.

> Example request:

```bash
curl -X GET "http://localhost/admin/events" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/events",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/events`

`HEAD admin/events`


<!-- END_70b38920b4ad2d0327e6a90b14cdb244 -->

<!-- START_1094a077ddd008cc439f238f54e6dbc0 -->
## Admin Tradeshows

Returns a Page containing <strong><u>all</u></strong> published(enabled) tradeshows.

> Example request:

```bash
curl -X GET "http://localhost/admin/tradeshows" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/tradeshows",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/tradeshows`

`HEAD admin/tradeshows`


<!-- END_1094a077ddd008cc439f238f54e6dbc0 -->

<!-- START_f8564814314b85755abad490ee73d8c1 -->
## Create Event Page

Returns a Page(with recently created events) where you can create a new event.

> Example request:

```bash
curl -X GET "http://localhost/admin/event/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/event/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/event/create`

`HEAD admin/event/create`


<!-- END_f8564814314b85755abad490ee73d8c1 -->

<!-- START_cd8e8f9e95e12fe7daf184ad3bca167f -->
## Create Tradeshow Page

Returns a Page(with recently created tradeshows) where you can create a new tradeshow.

> Example request:

```bash
curl -X GET "http://localhost/admin/tradeshow/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/tradeshow/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/tradeshow/create`

`HEAD admin/tradeshow/create`


<!-- END_cd8e8f9e95e12fe7daf184ad3bca167f -->

<!-- START_06478ac7da0723308b44419eb6d24709 -->
## Create or Update Event/Tradeshow

Create a New Event/Tradeshow or Update Existing One
\@param      CreateOrUpdateEventOrTradeshow      $request <br>
\@return     void

> Example request:

```bash
curl -X POST "http://localhost/admin/event/create" \
-H "Accept: application/json" \
    -d "title"="et" \
    -d "summary"="et" \
    -d "description"="et" \
    -d "event_type"="1" \
    -d "new_event_image"="et" \
    -d "event_host"="2031" \
    -d "event_start_and_end_date"="et" \
    -d "price"="2031" \
    -d "availability"="limited" \
    -d "max_guest"="2031" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/event/create",
    "method": "POST",
    "data": {
        "title": "et",
        "summary": "et",
        "description": "et",
        "event_type": "1",
        "new_event_image": "et",
        "event_host": 2031,
        "event_start_and_end_date": "et",
        "price": 2031,
        "availability": "limited",
        "max_guest": 2031
},
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/event/create`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | Minimum: `5`
    summary | string |  required  | Minimum: `10`
    description | string |  required  | Minimum: `20`
    event_type | string |  required  | `1` or `2`
    new_event_image | image |  optional  | Must be an image (jpeg, png, bmp, gif, or svg)
    event_host | integer |  required  | 
    event_start_and_end_date | string |  required  | 
    price | integer |  required  | 
    availability | string |  required  | `limited` or `unlimited`
    max_guest | integer |  required  | 

<!-- END_06478ac7da0723308b44419eb6d24709 -->

<!-- START_27d4dfbc5c7bb7452d64b1808910726b -->
## admin/event/{event_slug?}

> Example request:

```bash
curl -X GET "http://localhost/admin/event/{event_slug?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/event/{event_slug?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/event/{event_slug?}`

`HEAD admin/event/{event_slug?}`


<!-- END_27d4dfbc5c7bb7452d64b1808910726b -->

<!-- START_05f435626f380602d7288c81755ddb45 -->
## admin/event/{event_slug}/{registrations}

> Example request:

```bash
curl -X GET "http://localhost/admin/event/{event_slug}/{registrations}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/event/{event_slug}/{registrations}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/event/{event_slug}/{registrations}`

`HEAD admin/event/{event_slug}/{registrations}`


<!-- END_05f435626f380602d7288c81755ddb45 -->

<!-- START_dc58c961913442ecd622427e718f124f -->
## admin/tradeshow/{event_slug?}

> Example request:

```bash
curl -X GET "http://localhost/admin/tradeshow/{event_slug?}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/tradeshow/{event_slug?}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/tradeshow/{event_slug?}`

`HEAD admin/tradeshow/{event_slug?}`


<!-- END_dc58c961913442ecd622427e718f124f -->

<!-- START_84b26185caff69eff186daef5d34e3bd -->
## admin/tradeshow/{event_slug}/{registrations}

> Example request:

```bash
curl -X GET "http://localhost/admin/tradeshow/{event_slug}/{registrations}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/tradeshow/{event_slug}/{registrations}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/tradeshow/{event_slug}/{registrations}`

`HEAD admin/tradeshow/{event_slug}/{registrations}`


<!-- END_84b26185caff69eff186daef5d34e3bd -->

<!-- START_ec99ea6400cfb7de22b1cebfc581aa46 -->
## Admin Ads

Returns a Page containing all sag ads.

> Example request:

```bash
curl -X GET "http://localhost/admin/ads" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/ads",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/ads`

`HEAD admin/ads`


<!-- END_ec99ea6400cfb7de22b1cebfc581aa46 -->

<!-- START_db5e3e3611958247ffe7948334f6983a -->
## Create Ads Page

Returns a Page(with recently created ads) where you can create a new photo or video ad.

> Example request:

```bash
curl -X GET "http://localhost/admin/ad/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/ad/create",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/ad/create`

`HEAD admin/ad/create`


<!-- END_db5e3e3611958247ffe7948334f6983a -->

<!-- START_2dd060b74f75888921cd5e76fb572e2d -->
## Create or Update Ads

Create a New Photo/Video Ad or Update Existing One <br>
\@param      Request      $request <br>
\@return     void

> Example request:

```bash
curl -X POST "http://localhost/admin/ad/create" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/ad/create",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/ad/create`


### Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | -------
create_or_update | string | required | `create` Or `update`
ad_title | string | required | Photo or Video Ad Title
ad_type | string | required | `photo` Or `video` , Photo Ad or Video Ad
ad_link | string | required | Complete Ad Link eg. `https://example.com/ads`
ad_background_image | image | required | Ad Background Image. Must be an image (jpeg, png, bmp, gif, or svg)
add_start_and_end_date | string | required | Ad start date - Ad end date. eg `06/24/2017 12:00 AM - 06/30/2017 11:59 PM`
ad_video_link | string | optional | Video Ad Link, required if `ad_type` is `video` eg. `https://www.youtube.com/watch?v=ahjSt68Rtvc`
ad_id | integer | optional | Ad ID. Required if `create_or_update` is `update`

<!-- END_2dd060b74f75888921cd5e76fb572e2d -->

<!-- START_48e56436bfe08fce168479efd0447707 -->
## admin/ad/{add}

> Example request:

```bash
curl -X GET "http://localhost/admin/ad/{add}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/ad/{add}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/ad/{add}`

`HEAD admin/ad/{add}`


<!-- END_48e56436bfe08fce168479efd0447707 -->

<!-- START_b7cb6851a250cb72664bc956a4c5fe6c -->
## Subscribers

Returns a Page containing all sag subscribers.

> Example request:

```bash
curl -X GET "http://localhost/admin/subscribers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/subscribers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/subscribers`

`HEAD admin/subscribers`


<!-- END_b7cb6851a250cb72664bc956a4c5fe6c -->

<!-- START_7cfacbba9599d84109fe31f160185dc1 -->
## Admin Gallery

Returns a Page containing all sag gallery photos.

> Example request:

```bash
curl -X GET "http://localhost/admin/gallery" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/gallery",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/gallery`

`HEAD admin/gallery`


<!-- END_7cfacbba9599d84109fe31f160185dc1 -->

<!-- START_b3583502628be215b041c81f8a8d9093 -->
## admin/event/{event_slug}/images

> Example request:

```bash
curl -X POST "http://localhost/admin/event/{event_slug}/images" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/event/{event_slug}/images",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/event/{event_slug}/images`


<!-- END_b3583502628be215b041c81f8a8d9093 -->

<!-- START_62927ddc42829d8bdffb4174f09f4d18 -->
## admin/create-host

> Example request:

```bash
curl -X POST "http://localhost/admin/create-host" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/create-host",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/create-host`


<!-- END_62927ddc42829d8bdffb4174f09f4d18 -->

<!-- START_e1ace1ed6cfc2a2f823814fd4d9bbbaf -->
## admin/search

> Example request:

```bash
curl -X POST "http://localhost/admin/search" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/search",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/search`


<!-- END_e1ace1ed6cfc2a2f823814fd4d9bbbaf -->

<!-- START_4dfa872e1a6d378b2bf1e57b91b995c2 -->
## admin/upload-gallery-images

> Example request:

```bash
curl -X POST "http://localhost/admin/upload-gallery-images" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/upload-gallery-images",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/upload-gallery-images`


<!-- END_4dfa872e1a6d378b2bf1e57b91b995c2 -->

<!-- START_a8944f51a4d261d7438e15e972ff8615 -->
## admin/mass-email

> Example request:

```bash
curl -X POST "http://localhost/admin/mass-email" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/mass-email",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/mass-email`


<!-- END_a8944f51a4d261d7438e15e972ff8615 -->

<!-- START_e319f39b014bef19ef2098b24eac9075 -->
## admin/delete-event-image

> Example request:

```bash
curl -X POST "http://localhost/admin/delete-event-image" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/delete-event-image",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/delete-event-image`


<!-- END_e319f39b014bef19ef2098b24eac9075 -->

<!-- START_616b0b4fcc986327ebf2afa36847b4b1 -->
## admin/delete-gallery-image

> Example request:

```bash
curl -X POST "http://localhost/admin/delete-gallery-image" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/delete-gallery-image",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST admin/delete-gallery-image`


<!-- END_616b0b4fcc986327ebf2afa36847b4b1 -->

<!-- START_987271b3b5792e96f76a77ff44e6001a -->
## delete-event-registred-member/{regId}

> Example request:

```bash
curl -X GET "http://localhost/delete-event-registred-member/{regId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/delete-event-registred-member/{regId}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET delete-event-registred-member/{regId}`

`HEAD delete-event-registred-member/{regId}`


<!-- END_987271b3b5792e96f76a77ff44e6001a -->

<!-- START_d089e2780ca684a62c5081b30b4d5e1e -->
## admin/delete-event/{eventId}

> Example request:

```bash
curl -X GET "http://localhost/admin/delete-event/{eventId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/delete-event/{eventId}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/delete-event/{eventId}`

`HEAD admin/delete-event/{eventId}`


<!-- END_d089e2780ca684a62c5081b30b4d5e1e -->

<!-- START_cd7f624bd1c265f96b3fc554ecc5137b -->
## admin/delete-ad/{ad_id}

> Example request:

```bash
curl -X GET "http://localhost/admin/delete-ad/{ad_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/delete-ad/{ad_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/delete-ad/{ad_id}`

`HEAD admin/delete-ad/{ad_id}`


<!-- END_cd7f624bd1c265f96b3fc554ecc5137b -->

<!-- START_62c453c9b1998e5c65e0527f6fbb5540 -->
## admin/delete-subscriber/{sub_id}

> Example request:

```bash
curl -X GET "http://localhost/admin/delete-subscriber/{sub_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/admin/delete-subscriber/{sub_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET admin/delete-subscriber/{sub_id}`

`HEAD admin/delete-subscriber/{sub_id}`


<!-- END_62c453c9b1998e5c65e0527f6fbb5540 -->

<!-- START_0ed5982b5caa59b3e8030e501b11f477 -->
## datatables/get-all-events/{ev_type}

> Example request:

```bash
curl -X GET "http://localhost/datatables/get-all-events/{ev_type}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/datatables/get-all-events/{ev_type}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET datatables/get-all-events/{ev_type}`

`HEAD datatables/get-all-events/{ev_type}`


<!-- END_0ed5982b5caa59b3e8030e501b11f477 -->

<!-- START_68aefa52701722e578000394a910bc5d -->
## datatables/get-all-ads

> Example request:

```bash
curl -X GET "http://localhost/datatables/get-all-ads" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/datatables/get-all-ads",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET datatables/get-all-ads`

`HEAD datatables/get-all-ads`


<!-- END_68aefa52701722e578000394a910bc5d -->

<!-- START_43f9006ec8ff1a6d53e2cc717351027a -->
## datatables/get-all-event-registred-members/{event_id}

> Example request:

```bash
curl -X GET "http://localhost/datatables/get-all-event-registred-members/{event_id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/datatables/get-all-event-registred-members/{event_id}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET datatables/get-all-event-registred-members/{event_id}`

`HEAD datatables/get-all-event-registred-members/{event_id}`


<!-- END_43f9006ec8ff1a6d53e2cc717351027a -->

<!-- START_c025f57e06b83a19b152f580fbaa1c8d -->
## datatables/get-all-subscribers

> Example request:

```bash
curl -X GET "http://localhost/datatables/get-all-subscribers" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/datatables/get-all-subscribers",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "error": "Unauthenticated."
}
```

### HTTP Request
`GET datatables/get-all-subscribers`

`HEAD datatables/get-all-subscribers`


<!-- END_c025f57e06b83a19b152f580fbaa1c8d -->

