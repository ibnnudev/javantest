CREATE TABLE `silsilah_keluarga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `id_orangtua` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orangtua_idx` (`id_orangtua`),
  CONSTRAINT `silsilah_keluarga_fk0` FOREIGN KEY (`id_orangtua`) REFERENCES `silsilah_keluarga` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert data ke dalam tabel `silsilah_keluarga`
INSERT INTO `silsilah_keluarga` (`nama`, `jenis_kelamin`, `id_orangtua`) VALUES
('Budi', 'L', NULL),
('Dedi', 'L', 1),
('Dodi', 'L', 1),
('Dede', 'L', 1),
('Dewi', 'P', 1),
('Feri', 'L', 2),
('Farah', 'P', 2),
('Gugus', 'L', 3),
('Candi', 'P', 3),
('Hani', 'P', 4),
('Hana', 'P', 4);

-- Mendapatkan anak Budisilsilah_keluarga
SELECT * FROM `silsilah_keluarga` WHERE `id_orangtua` = (SELECT `id` FROM `silsilah_keluarga` WHERE `nama` = 'Budi');

-- Mendapatkan cucu Budi
SELECT * FROM `silsilah_keluarga` WHERE `id_orangtua` IN (SELECT `id` FROM `silsilah_keluarga` WHERE `id_orangtua` = (SELECT `id` FROM `silsilah_keluarga` WHERE `nama` = 'Budi'));

-- Mendapatkan cucu perempuan dari Budi
SELECT * FROM `silsilah_keluarga` WHERE `jenis_kelamin` = 'P' AND `id_orangtua` IN (SELECT `id` FROM `silsilah_keluarga` WHERE `id_orangtua` = (SELECT `id` FROM `silsilah_keluarga` WHERE `nama` = 'Budi'));

-- Buat query untuk mendapatkan bibi dari Farah
SELECT *
FROM silsilah_keluarga
WHERE id_orangtua = 1 AND jenis_kelamin = 'P';

-- Mendapatkan sepupu laki-laki dari Hani
SELECT *
FROM silsilah_keluarga
WHERE id_orangtua IN (
    SELECT id
    FROM silsilah_keluarga
    WHERE id_orangtua IN (
        SELECT id_orangtua
        FROM silsilah_keluarga
        WHERE id IN (
            SELECT id_orangtua
            FROM silsilah_keluarga
            WHERE nama = 'Hani'
        )
    )
)
AND jenis_kelamin = 'L'
AND nama != 'Hani';
