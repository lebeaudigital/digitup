<?php
if (!function_exists('dechex_bcmath')) {
    function dechex_bcmath($num)
    {
        $hex = '';
        while (bccomp($num, '0') > 0) {
            $mod = bcmod($num, '16');
            $hex = "0123456789abcdef"[(int)$mod] . $hex;
            $num = bcdiv($num, '16', 0);
        }
        return $hex ?: '0';
    }
}

if (!function_exists('hexdec_bcmath')) {
    function hexdec_bcmath($hex)
    {
        $dec = '0';
        foreach (str_split($hex) as $char) {
            $dec = bcadd(bcmul($dec, '16'), (string)strpos('0123456789abcdef', $char));
        }
        return $dec;
    }
}

if (!function_exists('base58_encode')) {
    function base58_encode($data)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $num = hexdec_bcmath(bin2hex($data)); // Conversion hex → décimal
        $encoded = '';

        while (bccomp($num, '58') > 0) {
            $mod = bcmod($num, '58');
            $num = bcdiv($num, '58', 0);
            $encoded = $alphabet[(int)$mod] . $encoded;
        }

        return $alphabet[(int)$num] . $encoded;
    }
}

if (!function_exists('base58_decode')) {
    function base58_decode($data)
    {
        $alphabet = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $num = '0';

        foreach (str_split($data) as $char) {
            $num = bcadd(bcmul($num, '58'), (string)strpos($alphabet, $char));
        }

        $hex = dechex_bcmath($num); // ✅ Correction ici
        if (strlen($hex) % 2 !== 0) {
            $hex = '0' . $hex;
        }

        return hex2bin($hex);
    }
}

if (!function_exists('crypto')) {
    function crypto($data)
    {
        $key = sodium_crypto_generichash('ma_cle_32chars', '', SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES);
        $nonce = random_bytes(SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES); // ✅ 12 octets
        $ciphertext = sodium_crypto_aead_chacha20poly1305_ietf_encrypt($data, '', $nonce, $key);

        return base58_encode($nonce . $ciphertext); // ✅ Aucun troncage
    }
}

if (!function_exists('decrypto')) {
    function decrypto($hash)
    {
        $key = sodium_crypto_generichash('ma_cle_32chars', '', SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_KEYBYTES);
        $decoded = base58_decode($hash);

        if ($decoded === false || strlen($decoded) < SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES) {
            return false; // ✅ Vérification stricte
        }

        $nonce = substr($decoded, 0, SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES);
        $ciphertext = substr($decoded, SODIUM_CRYPTO_AEAD_CHACHA20POLY1305_IETF_NPUBBYTES);

        return sodium_crypto_aead_chacha20poly1305_ietf_decrypt($ciphertext, '', $nonce, $key) ?: false;
    }
}