<?php
tablecheck('user', 'CREATE TABLE `user` (
        `id` int(11) NOT NULL,
        `userid` varchar(50) NOT NULL,
        `email` varchar(150) NOT NULL,
        `password` text NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;', $pdo);

function tablecheck($tablename, $table, $pdo)
{
    if (empty($pdo)) return 404;
    if (empty($tablename)) return 404;
    if (empty($table)) return 404;

    $check = $pdo->query("SHOW TABLES LIKE `$tablename`");
    $row = $check->fetch();

    if (!$row) {
        $newtable = $pdo->prepare($table);

        if ($newtable->execute()) {
            $addincrement = $pdo->prepare("ALTER TABLE `$tablename`
                    ADD PRIMARY KEY (`id`);");
            if($addincrement->execute()) {
                return 200;
            } else {
                return 201;
            }
        } else {
            return 403;
        }
    } else {
        return 402;
    }
}
