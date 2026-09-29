$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    $newContent = @()
    foreach ($line in $content) {
        # Border radius
        if ($line -match 'border-radius:\s*(\d+)px\s*(!important)?;') {
            $val = [int]$matches[1]
            $important = if ($matches[2]) { " !important" } else { "" }
            
            $var = ""
            if ($val -le 6) { $var = "var(--radius-sm)" } # 4px
            elseif ($val -le 10) { $var = "var(--radius-md)" } # 8px
            elseif ($val -le 16) { $var = "var(--card-radius)" } # 12px
            else { $var = "var(--radius-pill)" } # 20px
            
            $line = $line -replace 'border-radius:\s*\d+px\s*(!important)?', "border-radius: $var$important"
        }
        
        # Box shadow
        if ($line -match 'box-shadow:\s*0\s+[2-9]px\s+\d+px\s+rgba\(0,\s*0,\s*0,\s*0\.[0-9]+\)\s*;') {
            $line = $line -replace 'box-shadow:[^;]+', "box-shadow: var(--card-shadow)"
        }
        
        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
