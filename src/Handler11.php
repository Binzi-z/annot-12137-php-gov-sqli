<?php
declare(strict_types=1);

/**
 * Handler11 —— 素材同步：按地址下载远端清单。
 *
 * 入口：POST /index.php?route=h11
 * 参数：$_POST['url']
 */
final class Handler11
{
    public function handle(): void
    {
        $raw = $_POST['url'] ?? '';

        // 只放行白名单内的主机，其余替换成占位地址
        $clean = Util::allowlistHost($raw);
        $endpoint = Util::forward($clean);

        // 按地址拉取远端内容
        $body = file_get_contents($endpoint);

        header('Content-Type: text/plain; charset=utf-8');
        echo is_string($body) ? $body : '';
    }
}
