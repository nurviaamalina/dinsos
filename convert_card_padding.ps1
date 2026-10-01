$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    
    $newContent = @()
    $inCard = $false
    
    foreach ($line in $content) {
        if ($line -match '\{') {
            # Start of a rule
            if ($line -match 'card|box|item') {
                $inCard = $true
            } else {
                $inCard = $false
            }
        }
        
        if ($inCard -and $line -match 'padding:\s*(\d+)px\s*;') {
            $val = [int]$matches[1]
            if ($val -ge 20) {
                $line = $line -replace "padding:\s*$val" + "px", "padding: var(--card-padding)"
            } elseif ($val -ge 12) {
                $line = $line -replace "padding:\s*$val" + "px", "padding: var(--card-padding-sm)"
            }
        }
        
        if ($line -match '\}') {
            $inCard = $false
        }
        
        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
