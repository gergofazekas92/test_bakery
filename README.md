# test_task_bakery

A feladatot commandok létrehozásával oldottam meg, a feladat leírások alatt találhatóak a megoldást tartalmazó commandok.

FELADAT

A feladat egy pékség működéséhez kapcsolódik. A data.json fájlban találod a termékek receptjeit és tulajdonságait az aktuális készletet az alapanyagokból, az utolsóhét eladásait és az alapanyagok beszerzési árait.

1. Dolgozd fel a csatolt data.json fájlt és mentsd el egy adatbázisba
2. Számold ki az utolsó hét árbevételét
   php artisan calculate:revenue
3. Külön listában jelenítsd meg a gluténmentes, a laktózmentes és a glutén és laktózmentes termékek nevét és árát
   php artisan list:free-products
4. Számold ki az utolsó hét profitját (bevétel-alapanyag_költség)
   php artisan calculate:profit
5. Számold ki hogy a különböző termékekből külön-külön mennyit lehet maximum legyártani a jelenlegi készletből
   php artisan calculate:max-production
6. Számold ki a következő rendelés költségét és profitját
   php artisan calculate:order-profit

Francia krémes 300 db
Rákóczi túrós 200 db
Képviselőfánk 300 db
Isler 100 db
Tiramisu 150 db
