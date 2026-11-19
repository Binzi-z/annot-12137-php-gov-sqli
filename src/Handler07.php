<?php
declare(strict_types=1);

/**
 * Handler07 —— 出站连通性检查：抓取对端首页做存活判断。
 *
 * 入口：GET/POST /index.php?route=h07
 * 参数：$_REQUEST['target']
 */
final class Handler07
{
    public function handle(): void
    {
        $raw = $_REQUEST['target'] ?? '';

        // 整个参数加单引号，避免被 shell 拆词
        $clean = escapeshellarg($raw);
        $target = Util::forward($clean);

        // 按参数发起探测命令
        $output = shell_exec("/usr/bin/curl -sS --max-time 3 " . $target);

        echo Util::escape(is_string($output) ? $output : '');
    }
}
