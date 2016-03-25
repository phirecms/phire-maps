--
-- Maps Module PostgreSQL Database for Phire CMS 2.0
--

-- --------------------------------------------------------

--
-- Table structure for table "maps"
--

CREATE SEQUENCE map_id_seq START 15001;

DROP TABLE IF EXISTS "[{prefix}]maps" CASCADE;
CREATE TABLE IF NOT EXISTS "[{prefix}]maps" (
  "id" integer NOT NULL DEFAULT nextval('map_id_seq'),
  "name" varchar(255) NOT NULL,
  "longitude" varchar(255),
  "latitude" varchar(255),
  "pin_icon" varchar(255),
  "zoom" integer,
  "satellite" integer,
  PRIMARY KEY ("id")
) ;

ALTER SEQUENCE map_id_seq OWNED BY "[{prefix}]maps"."id";

-- --------------------------------------------------------

--
-- Table structure for table "map_locations"
--

CREATE SEQUENCE map_location_id_seq START 16001;

DROP TABLE IF EXISTS "[{prefix}]map_locations" CASCADE;
CREATE TABLE IF NOT EXISTS "[{prefix}]map_locations" (
  "id" integer NOT NULL DEFAULT nextval('map_location_id_seq'),
  "map_id" integer,
  "title" varchar(255) NOT NULL,
  "uri" varchar(255),
  "info" text,
  "longitude" varchar(255),
  "latitude" varchar(255),
  PRIMARY KEY ("id"),
  CONSTRAINT "fk_map_location" FOREIGN KEY ("map_id") REFERENCES "[{prefix}]maps" ("id") ON DELETE SET NULL ON UPDATE CASCADE
) ;

ALTER SEQUENCE map_location_id_seq OWNED BY "[{prefix}]map_locations"."id";
