# Házi feladat

Ebbe a könyvtárba kerül az opcionális **házi feladat** megoldása. Továbbá ide kell majd a specifikációt is elkészíteni. 

## Beadás és értékelés
> [!IMPORTANT]
> A specifikációt és a házi feladatot a laborokhoz hasonlóan pull request formájában kell beadni a határidő előtt a Moodle alatt található **Git tudnivalók** leírásban található utasítások alapján.
> - Hozz létre egy **új branchet** `megoldas` néven, és ezen dolgozz.
> - Töltsd ki a `neptun.txt` fájlt a saját Neptun kódoddal.
> - Minden egyes részegység után kommitolj, és használj értelmes kommit üzeneteket.
> - A feladat végeztével **pushold** a megoldásodat és hozz létre egy **pull requestet**.
> - Ellenőrizd a pull request tartalmát és rendeld hozzá a laborvezetődet **reviewernek**.

> [!CAUTION]
> A nem ilyen formában megadott megoldások nem lesznek értékelve!

## Specifikáció

### A feladat rövid bemutatása

A feladat célja, egy olyan oldal létrehozása, amely segít receptek tárolásában,
másokkal megosztásában. Új recept felvétele regisztrációhoz kötött, de a megosztottak megtekintése bejelentkezés nélkül is lehetséges. Egy receptre kattintva
láthatjuk, szükséges alapanyagokat, illetve a elkészítéshez segítséget.
 
### Az adatbázis sémája 

#### Entitások és attribútumaik:

- Felhasználó
    - id
    - felhasználónév
    - jelszó
    - név

- Recept
    - id
    - cím
    - leírás
    - főzési idő
    - hozzáadás dátuma

- Hozzávalók
    - id
    - megnevezés
    - mértékegység


![Adatbázis vázlat](/db_sch.PNG)
### I. Ábra: Entitások vázlata, és kapcsolata

### Elérhető oldalak és funkciók listája

- Bejelentkezés
    - regisztrációs oldal elérése
    - már létező felhasználóba belépés

- Kijelentkezés
    - felhasználói munkamenet elhagyása

- Profil
    - a felhasználó saját adatainak megtekintése, szerkesztése
    - fiók törlése

- Receptek
    - összes feltöltött recept böngészésec

- Saját receptek
    - saját receptek listája
    - receptre kattintva azok szerkesztése, törlése

- Egy recept oldala
    - megnyitott recept saját oldala
    - itt olvasható róla részletek

- Kedvencek
    - receptek kedvencekhez adható

- Keresés összetevő alapján
    - kilistázza azokat a recepteket, amelyekben szerepel az adott összetevő

## Elkészült házi feladat

A házi feladat működését bemutató videó (max. 5 perc) linkje: [Videó](https://youtu.be/P6cCoiIlgD4) 
