$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    $newContent = @()
    foreach ($line in $content) {
        # Danger / Error (Reds)
        $line = $line -replace '(?i)#(?:dc3545|c82333|e93648|c92537|ff3030|f03333|ff5555|df3046|e52b4a|c9213c|c9002b|dc263f|b91c32|e83152|e94d68|dc2626|ef4444|b91c1c|842029)\b', 'var(--danger-color)'
        $line = $line -replace '(?i)#(?:f8d7da|f5c6cb|f5c2c7|ffe1e1|fdf2f4|fef2f2|fecaca|fff2f2|fbe8ec|f0d9df|f4e9ed|f7cbd2)\b', 'var(--danger-light)'
        
        # Success (Greens)
        $line = $line -replace '(?i)#(?:28a745|218838|155724|388447|397642|43894d|448b70|30c98b|5eb273|68b17b|75c77c|22b83d|2b6e22|58a96d|065f46|16a34a|10b981|047857|238636|0f5132)\b', 'var(--success-color)'
        $line = $line -replace '(?i)#(?:d4edda|c3e6cb|e7f6ea|e8f7eb|eef9f0|e9f8ea|dcf9eb|eaf5ea|d1ebd0|f0faf3|dcfce7|d1e7dd|badbcc)\b', 'var(--success-light)'
        
        # Warning (Yellows/Oranges)
        $line = $line -replace '(?i)#(?:ffc107|e0a800|e9ae28|f0a51a|ffb52e|f2a72e|ff8700|f9b62d|e5a000|d39a00|856404|b78b00|e1a900)\b', 'var(--warning-color)'
        $line = $line -replace '(?i)#(?:fff3cd|fff3c9|fff8e1|ffe082|fff2c9|f5e6bd|fff4c7)\b', 'var(--warning-light)'
        
        # Info (Blues)
        $line = $line -replace '(?i)#(?:17a2b8|138496|084298|3d57d6|3475ed|406cb4|3a5cd7|4a6cf7|1a73e8|2997D8)\b', 'var(--info-color)'
        $line = $line -replace '(?i)#(?:cfe2ff|e0edfe|f4f8ff|dcebed)\b', 'var(--info-light)'

        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
