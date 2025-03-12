<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostname = htmlspecialchars($_POST['hostname']);
    $enable_secret = password_hash($_POST['enable_secret'], PASSWORD_DEFAULT);
    $telnet_password = password_hash($_POST['telnet_password'], PASSWORD_DEFAULT);
    $console_password = password_hash($_POST['console_password'], PASSWORD_DEFAULT);
    $banner = htmlspecialchars($_POST['banner']);
    $datetime = htmlspecialchars($_POST['datetime']);
    $routing = isset($_POST['routing']) ? "ip routing" : "! Enrutament no activat";
    $ip_f0_0 = htmlspecialchars($_POST['ip_f0_0']);
    $mask_f0_0 = htmlspecialchars($_POST['mask_f0_0']);
    $ip_f0_1 = htmlspecialchars($_POST['ip_f0_1']);
    $mask_f0_1 = htmlspecialchars($_POST['mask_f0_1']);

    echo "<pre>";
    echo "! Configuració inicial del Router Cisco 2811\n";
    echo "hostname $hostname\n";
    echo "enable secret $enable_secret\n";
    echo "banner motd #$banner#\n";
    echo "! Configurant contrasenyes d'accés\n";
    echo "line vty 0 4\n password $telnet_password\n login\n exit\n";
    echo "line console 0\n password $console_password\n login\n exit\n";
    echo "$routing\n";
    echo "! Configurant interfícies de xarxa\n";
    echo "interface FastEthernet0/0\n ip address $ip_f0_0 $mask_f0_0\n no shutdown\n exit\n";
    echo "interface FastEthernet0/1\n ip address $ip_f0_1 $mask_f0_1\n no shutdown\n exit\n";
    echo "! Copiant la configuració a startup-config\n";
    echo "write memory\n";
    echo "! Data i hora configurada: $datetime\n";
    echo "</pre>";
} else {
    echo "<p>Error: No s'ha enviat cap dada.</p>";
}
