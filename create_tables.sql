-- artiesten
CREATE TABLE IF NOT EXISTS artiesten (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naam TEXT NOT NULL,
    genre TEXT,
    foto TEXT NOT NULL
);

-- podia
CREATE TABLE IF NOT EXISTS podia (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naam TEXT NOT NULL,
    locatie TEXT
);

-- festival
CREATE TABLE IF NOT EXISTS festival (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    naam TEXT NOT NULL,
    locatie TEXT NOT NULL,
    datum_start DATETIME NOT NULL,
    datum_eind DATETIME NOT NULL,
    beschrijving TEXT
);

-- optreden
CREATE TABLE IF NOT EXISTS optreden (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    begin_tijd DATETIME NOT NULL,
    eind_tijd DATETIME NOT NULL,
    podium_id INTEGER NOT NULL,
    artiest_id INTEGER NOT NULL,
    festival_id INTEGER NOT NULL,
    FOREIGN KEY (podium_id) REFERENCES podia(id),
    FOREIGN KEY (artiest_id) REFERENCES artiesten(id),
    FOREIGN KEY (festival_id) REFERENCES festival(id)
);

-- tickets
CREATE TABLE IF NOT EXISTS tickets (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    vip INTEGER NOT NULL,
    dagticket INTEGER NOT NULL,
    weekendticket INTEGER NOT NULL,
    geldig_vanaf DATETIME NOT NULL,
    geldig_tot DATETIME NOT NULL
);

-- tickets_bestel
CREATE TABLE IF NOT EXISTS tickets_bestel (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ticket_id INTEGER NOT NULL,
    klant_id INTEGER NOT NULL,
    aantal_vip INTEGER NOT NULL,
    aantal_dagticket INTEGER NOT NULL,
    aantal_weekend INTEGER NOT NULL,
    besteld_op DATETIME NOT NULL,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id)
);