# Hackathon Scraper

[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat)](https://github.com/Codeinwp/hackathon-scraper)
[![Build Version](https://img.shields.io/badge/ver-1.0.0-blue.svg)](https://github.com/Codeinwp/hackathon-scraper)

Team 3 Hackathon Project - Scraper module

## Requirements

Scraping module for clients/users websites that are displayed 
in Showcase (http://prntscr.com/hmbrnz) and Pirate Switcher (http://prntscr.com/hmbrex)

These websites should be checked each week if there are live and still using the relevant 
theme for showcase.

Send an alert to a certain email.


## How does it work?

1. You can pass it a .csv file with links and slugs, and it will tell you if the link still uses
the theme slug specified.

2. You can select from the landing page a theme to check against and pass an URL and it will tell 
you if it uses that theme or not.

3. You can make a `POST` call to the API endpoints `?api=check_list` or `?api=check_url`
the payload should be of this form:
```
[
...
{
	link: 'http://my.special.example.com'
	slug: 'hestia-pro'
}
...
]
```

and the API will respond with an array of statuses for the passed payload ( `true` or `false` ) if the
passed slug is used for the given link.



## What does it check?

It checks if: 
- specific `class` and `id` from the specified slug on elements are used.
- the `style.css` comment attributes reflect that of the given slug defaults.


If all checks pass it marks the link for that slug as `true`, else it returns `false`

### Team members

Bogdan Preda -- Themeisle -- bogdan.preda@themeisle.com -- @preda-bogdan

Rodica Andronache -- Themeisle -- rodica@themeisle.com -- @rodica_elena91

Rohit Motwani -- Themeisle -- rohit@themeisle.com -- @rohittm

Poonam Namdev -- Themeisle -- poonam@themeisle.com -- @poonamnamdev2

Chris Fitzgerald -- Themeisle -- chris@themeisle.com -- @Chris_inRo

