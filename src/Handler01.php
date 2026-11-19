<?php
declare(strict_types=1);

/**
 * Handler01 —— 账号详情：按邮箱反查用户 ID。
 *
 * 入口：GET/POST /index.php?route=h01
 * 参数：$_REQUEST['email']
 */
final class Handler01
{
    public function handle(): void
    {
        $raw = $_REQUEST['email'] ?? '';

        $email = Util::forward($raw);

        // 按条件检索记录
        $db = Db::open();

        $rows = $db->query("SELECT id, email FROM users WHERE email = '" . $email . "'");

        echo json_encode($rows, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    }
}
