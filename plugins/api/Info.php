<?php
return [
    'name'          =>  'API',
    'description'   =>  'Katalog API mLITE',
    'author'        =>  'Basoro',
    'version'       =>  '1.0',
    'compatibility' =>  '2023',
    'icon'          =>  'database',
    'pages'         =>  ['API mLITE' => 'api'],
    'install'       =>  function () use ($core) {

      $core->mysql()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite__pengaduan` (
        `id` varchar(15) NOT NULL,
        `tanggal` datetime NOT NULL,
        `no_rkm_medis` varchar(15) NOT NULL,
        `pesan` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__pengaduan`
        ADD PRIMARY KEY (`id`),
        ADD KEY `no_rkm_medis` (`no_rkm_medis`);");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__pengaduan`
        ADD CONSTRAINT `mlite__pengaduan_ibfk_1` FOREIGN KEY (`no_rkm_medis`) REFERENCES `pasien` (`no_rkm_medis`) ON DELETE CASCADE ON UPDATE CASCADE;");


      $core->mysql()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite__pengaduan_detail` (
        `id` int(10) NOT NULL,
        `pengaduan_id` varchar(15) NOT NULL,
        `tanggal` datetime NOT NULL,
        `no_rkm_medis` varchar(15) NOT NULL,
        `pesan` varchar(225) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__pengaduan_detail`
        ADD PRIMARY KEY (`id`) USING BTREE,
        ADD KEY `pengaduan_detail_ibfk_1` (`pengaduan_id`);");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__pengaduan_detail`
        MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__pengaduan_detail`
        ADD CONSTRAINT `mlite__pengaduan_detail_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `mlite__pengaduan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;");

      $core->mysql()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite__notifications` (
        `id` int(11) NOT NULL,
        `judul` varchar(250) NOT NULL,
        `pesan` text NOT NULL,
        `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        `no_rkm_medis` varchar(255) NOT NULL,
        `status` varchar(250) NOT NULL DEFAULT 'unread'
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__notifications`
        ADD PRIMARY KEY (`id`);");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__notifications`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

      $core->mysql()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite__apamregister` (
        `nama_lengkap` varchar(225) NOT NULL,
        `email` varchar(225) NOT NULL,
        `nomor_ktp` varchar(225) NOT NULL,
        `nomor_telepon` varchar(225) DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;");

      $core->mysql()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite__duitku` (
        `id` varchar(10) NOT NULL,
        `tanggal` datetime NOT NULL,
        `no_rkm_medis` varchar(15) NOT NULL,
        `paymentUrl` varchar(255) NOT NULL,
        `merchantCode` varchar(255) NOT NULL,
        `reference` varchar(255) NOT NULL,
        `vaNumber` varchar(255) NOT NULL,
        `amount` varchar(255) NOT NULL,
        `statusCode` varchar(255) NOT NULL,
        `statusMessage` varchar(255) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__duitku`
        ADD PRIMARY KEY (`id`),
        ADD KEY `reference` (`reference`);");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__duitku`
        MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;");

      $core->mysql()->pdo()->exec("ALTER TABLE `mlite__duitku`
        ADD CONSTRAINT `mlite__duitku_ibfk_1` FOREIGN KEY (`no_rkm_medis`) REFERENCES `pasien` (`no_rkm_medis`) ON DELETE CASCADE ON UPDATE CASCADE;");

      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_key', 'qtbexUAxzqO3M8dCOo2vDMFvgYjdUEdMLVo341')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_status_daftar', 'Terdaftar')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_status_dilayani', 'Anda siap dilayani')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_webappsurl', 'http://localhost/webapps/')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_normpetugas', '000001,000002')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_limit', '2')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_smtp_host', 'ssl://smtp.gmail.com')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_smtp_port', '465')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_smtp_username', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_smtp_password', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_kdpj', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_kdprop', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_kdkab', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'apam_kdkec', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_merchantCode', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_merchantKey', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_paymentAmount', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_paymentMethod', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_productDetails', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_expiryPeriod', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'duitku_kdpj', '')");
      $core->db()->pdo()->exec("INSERT INTO `mlite__settings` (`module`, `field`, `value`) VALUES ('api', 'berkasdigital_key', 'qtbexUAxzqO3M8dCOo2vDMFvgYjdUEdMLVo341')");
    },
    'uninstall'     =>  function () use ($core) {
      $core->mysql()->pdo()->exec("DELETE FROM `mlite__settings` WHERE `module` = 'api'");
    }
];
