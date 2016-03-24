--
-- Maps Module PostgreSQL Database for Phire CMS 2.0
--

-- --------------------------------------------------------

--
-- Table structure for table "field_groups"
--
CREATE SEQUENCE map_id_seq START 15001;

DROP TABLE IF EXISTS "[{prefix}]maps" CASCADE;
CREATE TABLE IF NOT EXISTS "[{prefix}]maps" (
  "id" integer NOT NULL DEFAULT nextval('map_id_seq'),
  "name" varchar(255) NOT NULL,
  "locations" text,
  PRIMARY KEY ("id")
) ;

ALTER SEQUENCE map_id_seq OWNED BY "[{prefix}]maps"."id";