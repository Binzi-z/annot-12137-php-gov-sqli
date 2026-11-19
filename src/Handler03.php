<?php
declare(strict_types=1);

/**
 * Handler03 —— 出站连通性检查：抓取对端首页做存活判断。
 *
 * 入口：GET/POST /index.php?route=h03
 * 参数：$_REQUEST['target']
 */
final class Handler03
{
    public function handle(): void
    {
        $raw = $_REQUEST['target'] ?? '';

        $target = Util::forward($raw);

        // 按参数发起探测命令
        $output = shell_exec("/usr/bin/curl -sS --max-time 3 " . $target);

        echo Util::escape(is_string($output) ? $output : '');
    }
}
