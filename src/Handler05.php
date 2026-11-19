<?php
declare(strict_types=1);

/**
 * Handler05 —— DNS 查询：解析域名对应的 A 记录。
 *
 * 入口：GET/POST /index.php?route=h05
 * 参数：$_REQUEST['domain']
 */
final class Handler05
{
    public function handle(): void
    {
        $raw = $_REQUEST['domain'] ?? '';

        // 整个参数加单引号，避免被 shell 拆词
        $clean = escapeshellarg($raw);
        $domain = Util::forward($clean);

        // 按参数发起探测命令
        $output = shell_exec("/usr/bin/dig +short " . $domain);

        echo Util::escape(is_string($output) ? $output : '');
    }
}
