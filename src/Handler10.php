<?php
declare(strict_types=1);

/**
 * Handler10 —— Webhook 回显测试：请求外部地址。
 *
 * 入口：GET /index.php?route=h10
 * 参数：$_GET['webhook']
 */
final class Handler10
{
    public function handle(): void
    {
        $raw = $_GET['webhook'] ?? '';

        $endpoint = Util::forward($raw);

        // 按地址拉取远端内容
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $body = curl_exec($ch);
        curl_close($ch);

        header('Content-Type: text/plain; charset=utf-8');
        echo is_string($body) ? $body : '';
    }
}
