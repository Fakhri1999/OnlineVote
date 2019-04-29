-- USE DATABASE HERE
USE OnlineVote

-- CRUD HERE


-- GET COUNT FOR CHART
SELECT COUNT(v.id_pilihan) AS qty, p.nama_pilihan
FROM pilihan p LEFT JOIN voter v ON p.id_pilihan = v.id_pilihan
WHERE p.kode_room = 'RHPOL'
GROUP BY p.id_pilihan

-- GET DATA FOR FILE
SELECT r.*, COUNT(v.id_pilihan) AS qty, p.nama_pilihan, (SELECT COUNT(*)
   FROM voter v2
   WHERE v2.kode_room = 'lBESm') AS total
FROM pilihan p JOIN room r ON r.kode_room = p.kode_room LEFT JOIN voter v ON p.id_pilihan = v.id_pilihan
WHERE p.kode_room = 'lBESm'
GROUP BY p.id_pilihan

-- Database room active event
CREATE EVENT
IF NOT EXISTS activeExp
ON SCHEDULE EVERY 1 MINUTE
DO
UPDATE room SET active = 0
   WHERE CURDATE() > waktu_akhir

SET GLOBAL event_scheduler="ON"