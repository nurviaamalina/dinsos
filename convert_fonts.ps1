$files = Get-ChildItem -Path "public/assets/css" -Filter *.css -Recurse
foreach ($file in $files) {
    if ($file.Name -eq 'global.css') { continue }
    $content = Get-Content $file.FullName
    $newContent = @()
    foreach ($line in $content) {
        if ($line -match 'font-size:\s*([\d\.]+)px\s*(!important)?;') {
            $val = [double]$matches[1]
            $important = if ($matches[2]) { " !important" } else { "" }
            
            $var = ""
            if ($val -le 12) { $var = "var(--fs-xs)" }
            elseif ($val -lt 15) { $var = "var(--fs-sm)" }
            elseif ($val -lt 17) { $var = "var(--fs-base)" }
            elseif ($val -lt 19) { $var = "var(--fs-lg)" }
            elseif ($val -lt 22) { $var = "var(--fs-xl)" }
            elseif ($val -lt 27) { $var = "var(--fs-2xl)" }
            elseif ($val -lt 32) { $var = "var(--fs-3xl)" }
            else { $var = "var(--fs-4xl)" }
            
            $line = $line -replace 'font-size:\s*[\d\.]+px\s*(!important)?', "font-size: $var$important"
        }
        $newContent += $line
    }
    Set-Content -Path $file.FullName -Value $newContent
}
