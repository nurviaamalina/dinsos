$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    $newContent = @()
    foreach ($line in $content) {
        if ($line -match 'font-size:\s*([\d\.]+)rem\s*(!important)?;') {
            $val = [double]$matches[1]
            $important = if ($matches[2]) { " !important" } else { "" }
            
            $var = ""
            if ($val -le 0.75) { $var = "var(--fs-xs)" }
            elseif ($val -le 0.9) { $var = "var(--fs-sm)" }
            elseif ($val -le 1) { $var = "var(--fs-base)" }
            elseif ($val -le 1.15) { $var = "var(--fs-lg)" }
            elseif ($val -le 1.3) { $var = "var(--fs-xl)" }
            elseif ($val -le 1.6) { $var = "var(--fs-2xl)" }
            elseif ($val -le 2) { $var = "var(--fs-3xl)" }
            else { $var = "var(--fs-4xl)" }
            
            $line = $line -replace 'font-size:\s*[\d\.]+rem\s*(!important)?', "font-size: $var$important"
        }
        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
