# RIMAN/Cholot Development Workflow

## 📋 Projekt Übersicht

**Projekt**: RIMAN CMS mit Cholot Design Theme
**Stack**: Laravel 11 + Filament 3 + Blade Templates
**Repository**: https://github.com/holyghee/riman-cms-cholot-fork

## 🚀 Quick Start

### Lokale Entwicklung starten
```bash
# Server starten
cd /Users/holgerbrandt/dev/claude-code/projects/riman-cms-cholot-fork/riman-cms-unified
php artisan serve --port=8003

# In separatem Terminal: Asset-Compilation
npm run dev
```

### Zugriff
- **Frontend**: http://localhost:8003
- **Admin Panel**: http://localhost:8003/admin

## 🔄 Development Workflow

### 1. Feature Development

#### Schritt 1: Branch erstellen
```bash
git checkout -b feature/feature-name
```

#### Schritt 2: Änderungen implementieren
1. Blade Templates bearbeiten in `resources/views/cholot/`
2. CSS anpassen in `public/css/cholot-components.css`
3. JavaScript ergänzen in `resources/js/app.js`

#### Schritt 3: Assets kompilieren
```bash
npm run build
```

#### Schritt 4: Testing
```bash
# Unit Tests
php artisan test

# Browser Testing
npm run test:e2e
```

#### Schritt 5: Commit & Push
```bash
git add .
git commit -m "feat: Beschreibung der Änderung"
git push origin feature/feature-name
```

### 2. Design System Updates

#### CSS Änderungen
1. **Datei**: `public/css/cholot-components.css`
2. **Variablen**: Am Anfang der Datei definiert
3. **Komponenten**: Nach BEM-Methodik benannt

```css
/* Beispiel: Neue Komponente */
.cholot-new-component {
    /* Basis-Styles */
}

.cholot-new-component__element {
    /* Element-Styles */
}

.cholot-new-component--modifier {
    /* Modifier-Styles */
}
```

#### Blade Components
1. **Pfad**: `resources/views/components/cholot/`
2. **Naming**: `component-name.blade.php`
3. **Usage**: `<x-cholot.component-name />`

### 3. Content Management

#### Neue Seite erstellen
```php
// In HomeController oder PageController
$page = Page::create([
    'title' => 'Seitentitel',
    'slug' => 'seiten-slug',
    'template' => 'cholot-template',
    'status' => 'published',
    'blocks' => [
        // Block-Definitionen
    ]
]);
```

#### Block-Typen
- `cholot_hero` - Hero Section mit Video
- `cholot_services` - Service Grid
- `cholot_testimonials` - Kundenstimmen
- `cholot_cta` - Call-to-Action
- `text` - Rich Text Block

## 🎨 Design Guidelines

### Komponenten-Struktur

#### Hero Section
```blade
<div class="cholot-hero">
    <video class="cholot-hero-video" autoplay muted loop>
        <source src="{{ $video }}" type="video/mp4">
    </video>
    <div class="cholot-hero-content">
        <h1>{{ $title }}</h1>
        <p>{{ $subtitle }}</p>
    </div>
</div>
```

#### Service Cards
```blade
<div class="cholot-service-card">
    <div class="cholot-service-image">
        <img src="{{ $image }}" alt="{{ $title }}">
        <button class="cholot-play-button">▶</button>
    </div>
    <h3>{{ $title }}</h3>
    <p>{{ $description }}</p>
</div>
```

### CSS Klassen-Konventionen

```css
.cholot-[component]           /* Basis-Komponente */
.cholot-[component]__[element] /* Sub-Element */
.cholot-[component]--[modifier] /* Variante */
```

## 🔧 Technische Details

### Datei-Struktur
```
riman-cms-unified/
├── app/
│   ├── Http/Controllers/
│   │   └── HomeController.php
│   └── Models/
│       └── Page.php
├── resources/
│   ├── views/
│   │   └── cholot/
│   │       ├── page.blade.php
│   │       └── components/
│   └── js/
│       └── app.js
├── public/
│   └── css/
│       └── cholot-components.css
└── routes/
    └── web.php
```

### Video-Implementierung

#### Autoplay Hero Video
```javascript
// In app.js
document.addEventListener('DOMContentLoaded', function() {
    const heroVideos = document.querySelectorAll('.cholot-hero video');
    heroVideos.forEach(video => {
        video.autoplay = true;
        video.muted = true;
        video.loop = true;
        video.playsInline = true;
        video.controls = false;
    });
});
```

#### Video Modal für Service Cards
```javascript
// Modal öffnen
document.querySelectorAll('.cholot-play-button').forEach(button => {
    button.addEventListener('click', function() {
        const modal = document.querySelector('.cholot-video-modal');
        modal.style.display = 'flex';
        // Video laden und abspielen
    });
});
```

## 📊 Performance Optimierung

### Asset-Optimierung
```bash
# Production Build
npm run build

# Bilder optimieren
npm run optimize:images

# CSS purgen
npm run purge:css
```

### Caching
```php
// In Controller
$page = Cache::remember('page.'.$slug, 3600, function() use ($slug) {
    return Page::where('slug', $slug)->first();
});
```

## 🐛 Debugging

### Häufige Probleme

#### Problem: Video wird nicht abgespielt
```css
/* Lösung: Sicherstellen dass Video-Controls versteckt sind */
.cholot-hero video::-webkit-media-controls {
    display: none !important;
}
```

#### Problem: Modal friert ein
```css
/* Lösung: Z-Index und Display korrekt setzen */
.cholot-video-modal {
    display: none; /* nicht display: none !important */
    z-index: 10000;
}
```

### Debug-Commands
```bash
# Laravel Logs prüfen
tail -f storage/logs/laravel.log

# Browser Console für JS Fehler
# F12 -> Console

# CSS Debugging
# F12 -> Elements -> Styles
```

## 📦 Deployment

### Production Build
```bash
# 1. Assets builden
npm run build

# 2. Cache leeren
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# 3. Optimierung
php artisan optimize
php artisan route:cache
php artisan config:cache
```

### Git Workflow
```bash
# Feature fertig
git checkout main
git merge feature/feature-name
git push origin main

# Tag für Release
git tag -a v1.0.1 -m "Release version 1.0.1"
git push origin v1.0.1
```

## 📝 Dokumentation

### Code-Kommentare
```php
/**
 * Hero Section für Homepage
 * 
 * @param Page $page
 * @return View
 */
```

### CSS Dokumentation
```css
/**
 * Cholot Hero Component
 * Verwendung: Homepage Hero mit Autoplay Video
 * Modifiers: --fullscreen, --overlay
 */
```

## 🔐 Sicherheit

### Best Practices
- Keine Secrets im Code
- Environment Variables nutzen (.env)
- Input Validation
- XSS Protection
- CSRF Token

### Beispiel
```blade
{{-- Immer escapen --}}
{{ $userInput }}

{{-- Nur wenn HTML sicher ist --}}
{!! $trustedHtml !!}
```

## 📈 Monitoring

### Performance Tracking
- Google PageSpeed Insights
- Laravel Telescope (Development)
- Browser DevTools Performance Tab

### Error Tracking
- Laravel Logs
- Browser Console
- Network Tab für API Calls

## 🤝 Team Collaboration

### Code Review Checklist
- [ ] Code follows style guide
- [ ] Assets sind optimiert
- [ ] Responsive Design getestet
- [ ] Browser-Kompatibilität geprüft
- [ ] Performance akzeptabel
- [ ] Keine Console Errors
- [ ] Dokumentation aktualisiert

### Kommunikation
- Pull Requests für Code Review
- Issues für Bug Reports
- Discussions für Feature Requests

---

*Letztes Update: August 2025*
*Version: 1.0.0*