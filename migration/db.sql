CREATE TYPE type AS ENUM ('image', 'text', 'link');

CREATE TABLE "parse_results" (
	"id" SERIAL NOT NULL,
  "parse_site_id" INTEGER NOT NULL,
  "type" type,
	"count" INTEGER NOT NULL,
	"results" TEXT NULL ,
	"created_at" TIMESTAMP NULL,
	"updated_at" TIMESTAMP NULL,
	PRIMARY KEY ("id")
);

CREATE TABLE "parse_sites" (
	"id" SERIAL NOT NULL,
  "url" varchar(50) NOT NULL,
	"created_at" TIMESTAMP NULL,
	"updated_at" TIMESTAMP NULL,
	PRIMARY KEY ("id")
);

ALTER TABLE ONLY parse_results ADD CONSTRAINT parse_results_parse_site_id_foreign FOREIGN KEY (parse_site_id) REFERENCES parse_sites(id);
