# sirius, safari class
Simple, intuitive, _light_ and fast **safari class** and **accident report** web application

<p align="center">
  <img src="img/example.webp" width=45% />
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

## reports
The admins can download trip, near miss and accident reports in CSV format, [spreadsheets](https://en.wikipedia.org/wiki/Spreadsheet) suported by [Apple Numbers](https://en.wikipedia.org/wiki/Numbers_(spreadsheet)), [LibreOffice Calc](https://en.wikipedia.org/wiki/LibreOffice_Calc), and [Microsoft Excel](https://en.wikipedia.org/wiki/Microsoft_Excel) among others.

## built with

* [OpenBSD 7.2](https://www.openbsd.org)
* [PHP 8.1](https://www.php.net)
* [HTML5](https://html.spec.whatwg.org)
* [CSS3](https://www.w3.org/TR/CSS/#css)

## roadmap

* [x] automatic darkmode
* [x] responsive
* [x] manage users and userlevels (inactive, guide, admin)
* [x] download vcards with user contacts
* [x] create and activate safari templates
* [x] create and update personal trips
* [x] report accidents and close calls
* [x] download trips, accidents and near misses reports in csv format
* [ ] add work issues: accidents and near misses for the staff
* [ ] add 'days of the week' to safaris
* [ ] add pictures to the accident report
* [ ] add gear parts and prices
* [ ] print accident report pdf
* [ ] multi-language:
  - [x] english
  - [ ] spanish
  - [ ] finnish
