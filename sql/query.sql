-- USE DATABASE HERE
USE OnlineVote

-- CRUD HERE


-- GET COUNT FOR CHART
SELECT COUNT(v.id_pilihan) AS qty, p.nama_pilihan FROM pilihan p LEFT JOIN voter v ON p.id_pilihan = v.id_pilihan WHERE p.kode_room = 'RHPOL' GROUP BY p.id_pilihan