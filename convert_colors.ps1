$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    $newContent = @()
    foreach ($line in $content) {
        # Primary
        $line = $line -replace '(?i)#(?:65091c|650918|650719|6d061b|70091b|68091c|65091b|6b091c|720b20|780019|850923|650019|a50e28|8b1e3f)\b', 'var(--primary-color)'
        # Primary Hover
        $line = $line -replace '(?i)#(?:4d0615|4f0613|4e0613|4e0715|4d0716|5d0015|5d0b1b|4d0614|5c0f28|550b18|4d0612|4f0613)\b', 'var(--primary-color-hover)'
        # Text Main
        $line = $line -replace '(?i)#(?:222222|222|333333|333|444444|444|1a1a2e|212529|1e293b|111827|374151|30323a|24252b|101010|090909)\b', 'var(--text-main)'
        # Text Muted
        $line = $line -replace '(?i)#(?:555555|555|666666|666|777777|777|888888|888|999999|999|6c757d|6b7280|a0aec0|9ca3af|8b8d94|717680|a1a6b2|a5a7b0|555b66)\b', 'var(--text-muted)'
        # Border
        $line = $line -replace '(?i)#(?:aaaaaa|aaa|cccccc|ccc|dddddd|ddd|dedede|e1e1e1|e5e7eb|d1d5db|e2e8f0|c6c6c6|cfd3da|c5c5c5|d4d4d4|bcbcbc|d2d2d2|e0e0e0)\b', 'var(--border-color)'
        # Bg Light
        $line = $line -replace '(?i)#(?:f5f5f5|f8f8f8|f9f9fb|f9fafb|f4f8ff|f3f4f6|f8f9fa|f5f6f8|fdfdfd|f8fafc|fef8f9|fafbfc|f0f1f4|f6f7f8|f1f1f1|f5f9ff|fcfcfc|f7f7f7|fafafa|eeeeee|eee|e9e9e9)\b', 'var(--bg-light)'
        # Primary Light
        $line = $line -replace '(?i)#(?:f3a3b1|f5d8dd|f8bac5|f1aeb5|e3b6c0|fcf1f3|fce8ec|f8e7e7|fbe9e9|fff8f9|fff7f8|fdf2f4|f8e8ec|ead4da|f9eef0|f7d8df|eadde0|f7e9ec|f9eef0|f8eef1|fffafb|ead1d6)\b', 'var(--primary-light)'
        
        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
