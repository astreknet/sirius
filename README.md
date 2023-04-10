# sirius, safari class
Minimalistic **safari class** and **accident report** web application. Ask for a _testing account_ at the contact mail on the [site](https://sirius.astrek.net) 

<p align="center">
  <img src="img/example.webp" width=81% />
</p>

## users
Just an **email** is needed to create a user and the **password** for the **first login** will be the **same email**. On the first login the user is forced to _register_. Only the user can **edit his own data**. 

### userlevels
* **inactive**: _limbo_ status, can not log in.
* **guide**: can log in, create and update his own data, trips, close calls and accidents.
* **admin**: same privileges as guide. Also can create and modify safaris, upgrade userslevel, reset passwords, download [_vcards_](https://en.wikipedia.org/wiki/VCard) and [CSV](https://en.wikipedia.org/wiki/Comma-separated_values) reports.
* **superadmin**: same privileges as admin. Also can create and modify admins.

## safaris
This are the _templates_ of the _trips_. A safari has an **unique name**, a duration and it can be _active_, therefore _available_ for the _trips_.

## trips
An _active user_ can _add_ and _update_ trips. A trip has a _safari name_, _time_ and a _route_. _Remarks_ can be added later. A trip could have _near misses_ and _accidents_.

## issues
Work issues are _near misses_ or _accidents_, when the _injury_ field is filled, related to the guide on a safari or any situation during the work time.

## reports
The admins can download trip, near miss and accident reports in CSV format, [spreadsheets](https://en.wikipedia.org/wiki/Spreadsheet) suported by [Apple Numbers](https://en.wikipedia.org/wiki/Numbers_(spreadsheet)), [LibreOffice Calc](https://en.wikipedia.org/wiki/LibreOffice_Calc), and [Microsoft Excel](https://en.wikipedia.org/wiki/Microsoft_Excel) among others.

## built with
    
<a href="https://www.php.net" target="_blank">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="9%"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2023 Fonticons, Inc. --><path d="M320 104.5c171.4 0 303.2 72.2 303.2 151.5S491.3 407.5 320 407.5c-171.4 0-303.2-72.2-303.2-151.5S148.7 104.5 320 104.5m0-16.8C143.3 87.7 0 163 0 256s143.3 168.3 320 168.3S640 349 640 256 496.7 87.7 320 87.7zM218.2 242.5c-7.9 40.5-35.8 36.3-70.1 36.3l13.7-70.6c38 0 63.8-4.1 56.4 34.3zM97.4 350.3h36.7l8.7-44.8c41.1 0 66.6 3 90.2-19.1 26.1-24 32.9-66.7 14.3-88.1-9.7-11.2-25.3-16.7-46.5-16.7h-70.7L97.4 350.3zm185.7-213.6h36.5l-8.7 44.8c31.5 0 60.7-2.3 74.8 10.7 14.8 13.6 7.7 31-8.3 113.1h-37c15.4-79.4 18.3-86 12.7-92-5.4-5.8-17.7-4.6-47.4-4.6l-18.8 96.6h-36.5l32.7-168.6zM505 242.5c-8 41.1-36.7 36.3-70.1 36.3l13.7-70.6c38.2 0 63.8-4.1 56.4 34.3zM384.2 350.3H421l8.7-44.8c43.2 0 67.1 2.5 90.2-19.1 26.1-24 32.9-66.7 14.3-88.1-9.7-11.2-25.3-16.7-46.5-16.7H417l-32.8 168.7z"/></svg>
</a>
<a href="https://html.spec.whatwg.org" target="_blank"><img src="img/svg/html5.svg" alt="HTML5" width="4.5%" ></a>
<a href="https://www.w3.org/TR/CSS/#css" target="_blank"><img src="img/svg/css3-alt.svg" alt="CSS3" width="4.5%" ></a>
<a href="https://fontawesome.com" target="_blank"><img src="img/svg/font-awesome.svg" alt="Font Awesome" width="4.5%" ></a>

## roadmap

* [x] automatic darkmode
* [x] responsive
* [x] manage users and userlevels (inactive, guide, admin)
* [x] guide contact vcards
* [x] create and activate safari templates
* [x] create and update personal trips
* [x] report accidents and close calls
* [x] work issues: accidents and near misses for the staff
* [x] download CSV reports
    - [x] trips
    - [x] trip near misses
    - [x] trip accidents
    - [x] work near misses
    - [x] work accidents
* [ ] add geolocation button to near misses and accidents 
* [ ] add 'days of the week' to safaris
* [ ] add pictures to the accident report
* [ ] add gear parts and prices (snowmobiles, bikes, skis, etc...)
* [ ] accident report pdf
* [ ] multi-language:
  - [x] english
  - [ ] spanish
  - [ ] finnish
