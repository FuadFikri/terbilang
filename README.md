# terbilang
a library to convert a number to its word representation and vice versa (currently in Bahasa Indonesia language).


## Features
1. convert number to word (up to 36 digits of number)
2. convert word to number
3. convert every single number to its word representation and vice versa.


## How to use
```php
<?php

require '/path/to/library/terbilang.php';

$terbilang = new Terbilang();
echo $terbilang->toWord("1111");                      // seribu seratus sebelas

echo $terbilang->toNumber("seribu seratus sebelas");  // will return 1111
```
You can also use some dot to separate between numbers
```php
$terbilang = new Terbilang();
echo $terbilang->toWord("1.204.991.111");                      // satu miliar dua ratus empat juta sembilan ratus sembilan puluh satu ribu seratus sebelas
```
To convert every single number to its word representation, use toWordSingleRep()
```php
$terbilang = new Terbilang();
echo $terbilang->toWordSingleRep(100010);                     // output: "satu nol nol nol satu nol"
echo $terbilang->toWordSingleRep("100001");                   // output: "satu nol nol nol nol satu"
```
And vice versa (using toNumberSingleRep())
```php
$terbilang = new Terbilang();
echo $terbilang->toNumberSingleRep("satu nol nol nol satu nol");                      // output: "100010"
echo $terbilang->toNumberSingleRep("satu nol nol nol nol satu");                      // output: "100001"
```
