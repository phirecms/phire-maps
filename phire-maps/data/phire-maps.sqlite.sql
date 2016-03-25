--
-- Maps Module SQLite Database for Phire CMS 2.0
--

--  --------------------------------------------------------

--
-- Set database encoding
--

PRAGMA encoding = "UTF-8";
PRAGMA foreign_keys = ON;

-- --------------------------------------------------------

--
-- Table structure for table "maps"
--

CREATE TABLE IF NOT EXISTS "[{prefix}]maps" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" varchar NOT NULL,
  "longitude" varchar,
  "latitude" varchar,
  "pin_icon" varchar,
  "zoom" integer,
  "satellite" integer,
  UNIQUE ("id")
) ;

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('[{prefix}]maps', 15000);

-- --------------------------------------------------------

--
-- Table structure for table "map_locations"
--

CREATE TABLE IF NOT EXISTS "[{prefix}]map_locations" (
  "id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "map_id" integer,
  "title" varchar NOT NULL,
  "uri" varchar,
  "info" text,
  "longitude" varchar,
  "latitude" varchar,
  UNIQUE ("id")
) ;

INSERT INTO "sqlite_sequence" ("name", "seq") VALUES ('[{prefix}]map_locations', 16000);
