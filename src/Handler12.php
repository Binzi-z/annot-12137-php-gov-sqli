<?php
declare(strict_types=1);

/**
 * Handler12 —— 订单筛选：按状态查订单。
 *
 * 入口：GET /index.php?route=h12
 * 参数：$_GET['status']
 */
final class Handler12
{
    public function handle(): void
    {
        $raw = $_GET['status'] ?? '';

        $status = Util::forward($raw);

        // 按条件检索记录
        $db = Db::open();

        $rows = $db->query("SELECT * FROM orders WHERE status = '" . $status . "' ORDER BY id DESC");

        echo json_encode($rows, JSON_UNESCAPED_UNICODE) . PHP_EOL;
    }
}
