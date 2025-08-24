<?php

namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EncryptionService
{
    private const CIPHER = 'AES-256-CBC';
    private const CHUNK_SIZE = 8192; // 8KB chunks for file processing
    
    /**
     * Encrypt a string value
     */
    public function encryptString(string $value): string
    {
        return Crypt::encryptString($value);
    }
    
    /**
     * Decrypt a string value
     */
    public function decryptString(string $encrypted): string
    {
        return Crypt::decryptString($encrypted);
    }
    
    /**
     * Encrypt file contents and store
     */
    public function encryptFile(string $sourcePath, string $destinationPath): bool
    {
        try {
            $sourceContent = Storage::get($sourcePath);
            if (!$sourceContent) {
                return false;
            }
            
            // Generate encryption key for this file
            $key = $this->generateKey();
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(self::CIPHER));
            
            // Encrypt the content
            $encryptedContent = openssl_encrypt(
                $sourceContent,
                self::CIPHER,
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );
            
            // Store IV with encrypted content
            $finalContent = base64_encode($iv . $encryptedContent);
            
            // Store encrypted file
            Storage::put($destinationPath, $finalContent);
            
            // Store the key securely (in database, encrypted)
            $this->storeKey($destinationPath, $key);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('File encryption failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Decrypt file contents
     */
    public function decryptFile(string $encryptedPath): ?string
    {
        try {
            $encryptedContent = Storage::get($encryptedPath);
            if (!$encryptedContent) {
                return null;
            }
            
            // Decode the content
            $decoded = base64_decode($encryptedContent);
            
            // Extract IV
            $ivLength = openssl_cipher_iv_length(self::CIPHER);
            $iv = substr($decoded, 0, $ivLength);
            $encrypted = substr($decoded, $ivLength);
            
            // Retrieve the key
            $key = $this->retrieveKey($encryptedPath);
            if (!$key) {
                return null;
            }
            
            // Decrypt the content
            $decrypted = openssl_decrypt(
                $encrypted,
                self::CIPHER,
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );
            
            return $decrypted;
        } catch (\Exception $e) {
            \Log::error('File decryption failed: ' . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Generate a file hash for integrity checking
     */
    public function generateFileHash(string $path): string
    {
        $content = Storage::get($path);
        return hash('sha256', $content);
    }
    
    /**
     * Verify file integrity
     */
    public function verifyFileIntegrity(string $path, string $expectedHash): bool
    {
        $actualHash = $this->generateFileHash($path);
        return hash_equals($expectedHash, $actualHash);
    }
    
    /**
     * Securely delete a file by overwriting with random data
     */
    public function secureDelete(string $path): bool
    {
        try {
            if (!Storage::exists($path)) {
                return false;
            }
            
            $size = Storage::size($path);
            
            // Overwrite with random data 3 times
            for ($i = 0; $i < 3; $i++) {
                $randomData = openssl_random_pseudo_bytes($size);
                Storage::put($path, $randomData);
            }
            
            // Finally delete the file
            return Storage::delete($path);
        } catch (\Exception $e) {
            \Log::error('Secure delete failed: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Generate encryption key
     */
    private function generateKey(): string
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }
    
    /**
     * Store encryption key securely
     */
    private function storeKey(string $filePath, string $key): void
    {
        // Store in database, encrypted with master key
        \DB::table('encryption_keys')->insert([
            'file_path' => $filePath,
            'encryption_key' => Crypt::encryptString($key),
            'created_at' => now(),
        ]);
    }
    
    /**
     * Retrieve encryption key
     */
    private function retrieveKey(string $filePath): ?string
    {
        $record = \DB::table('encryption_keys')
            ->where('file_path', $filePath)
            ->first();
            
        if (!$record) {
            return null;
        }
        
        return Crypt::decryptString($record->encryption_key);
    }
    
    /**
     * Encrypt sensitive data fields
     */
    public function encryptData(array $data, array $fieldsToEncrypt): array
    {
        foreach ($fieldsToEncrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = $this->encryptString($data[$field]);
            }
        }
        
        return $data;
    }
    
    /**
     * Decrypt sensitive data fields
     */
    public function decryptData(array $data, array $fieldsToDecrypt): array
    {
        foreach ($fieldsToDecrypt as $field) {
            if (isset($data[$field])) {
                try {
                    $data[$field] = $this->decryptString($data[$field]);
                } catch (\Exception $e) {
                    \Log::error("Failed to decrypt field {$field}: " . $e->getMessage());
                    $data[$field] = null;
                }
            }
        }
        
        return $data;
    }
}