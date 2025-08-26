# RIMAN/Cholot Design System Style Guide

## 🎨 Design Philosophie

Das RIMAN/Cholot Design System kombiniert professionelle Eleganz mit moderner Benutzerfreundlichkeit. Die goldene Farbpalette vermittelt Vertrauen und Expertise, während die dunklen Hintergründe für einen premium Look sorgen.

## 📐 Design Prinzipien

### 1. **Klarheit & Struktur**
- Klare visuelle Hierarchie
- Konsistente Abstände und Ausrichtung
- Gut lesbare Typografie

### 2. **Eleganz & Professionalität**
- Goldene Akzente für Premium-Gefühl
- Dunkle Farbpalette für Seriosität
- Sanfte Animationen für Modernität

### 3. **Benutzerfreundlichkeit**
- Intuitive Navigation
- Responsive Design
- Barrierefreiheit (WCAG 2.1 AA)

## 🎨 Farbpalette

### Primärfarben
```css
--primary-gold: #B8860B;        /* Hauptgold */
--primary-gold-light: #D4A76A;  /* Helles Gold */
--primary-gold-dark: #8B6914;   /* Dunkles Gold */
--primary-gold-hover: #9A7209;  /* Hover-Zustand */
```

### Hintergrundfarben
```css
--background-dark: #1a1a1a;     /* Dunkler Hintergrund */
--background-light: #2a2a2a;    /* Heller Hintergrund */
```

### Textfarben
```css
--text-light: #ffffff;           /* Heller Text */
--text-muted: #b0b0b0;          /* Gedämpfter Text */
--text-dark: #333333;           /* Dunkler Text */
```

### Statusfarben
```css
--success: #28A745;             /* Erfolg */
--warning: #FFC107;             /* Warnung */
--danger: #DC3545;              /* Fehler */
--info: #2196F3;                /* Information */
```

## 📝 Typografie

### Schriftarten

#### Primärschrift (Überschriften)
- **Familie**: Montserrat
- **Gewichte**: 500 (Medium), 600 (Semi-Bold), 700 (Bold)
- **Verwendung**: Headlines, Buttons, Navigation

#### Sekundärschrift (Fließtext)
- **Familie**: Open Sans
- **Gewichte**: 400 (Regular), 600 (Semi-Bold)
- **Verwendung**: Body Text, Beschreibungen

### Schriftgrößen

```css
/* Display */
font-size: 3rem;      /* 48px - Hero Headlines */
font-weight: 700;

/* Heading 1 */
font-size: 2.5rem;    /* 40px - Hauptüberschriften */
font-weight: 700;

/* Heading 2 */
font-size: 2rem;      /* 32px - Sektionsüberschriften */
font-weight: 600;

/* Heading 3 */
font-size: 1.5rem;    /* 24px - Unterüberschriften */
font-weight: 500;

/* Body */
font-size: 1rem;      /* 16px - Fließtext */
font-weight: 400;
line-height: 1.8;

/* Small */
font-size: 0.875rem;  /* 14px - Klein Text */
font-weight: 400;
```

## 📏 Abstände & Layout

### Spacing System
```css
--spacing-xs: 0.25rem;  /* 4px */
--spacing-sm: 0.5rem;   /* 8px */
--spacing-md: 1rem;     /* 16px */
--spacing-lg: 2rem;     /* 32px */
--spacing-xl: 3rem;     /* 48px */
--spacing-2xl: 4rem;    /* 64px */
```

### Container
```css
max-width: 1400px;
margin: 0 auto;
padding: 0 2rem;
```

### Grid System
- 12-Spalten-Grid
- Responsive Breakpoints:
  - Mobile: < 768px
  - Tablet: 768px - 1024px
  - Desktop: > 1024px

## 🔲 Komponenten

### Buttons

#### Primary Button
```css
.btn-primary {
    background: linear-gradient(135deg, #B8860B 0%, #8B6914 100%);
    color: white;
    padding: 12px 32px;
    border-radius: 50px;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}
```

#### Secondary Button
```css
.btn-secondary {
    background: transparent;
    color: #B8860B;
    border: 2px solid #B8860B;
    padding: 12px 32px;
    border-radius: 50px;
}
```

### Cards
```css
.card {
    background: linear-gradient(135deg, rgba(42, 42, 42, 0.9), rgba(26, 26, 26, 0.9));
    border-radius: 12px;
    padding: 2rem;
    border: 1px solid rgba(184, 134, 11, 0.2);
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.4);
    border-color: #B8860B;
}
```

### Forms
```css
input, textarea {
    background: rgba(26, 26, 26, 0.8);
    border: 1px solid rgba(184, 134, 11, 0.3);
    border-radius: 8px;
    padding: 12px 16px;
    color: white;
    transition: all 0.3s ease;
}

input:focus {
    border-color: #B8860B;
    box-shadow: 0 0 0 3px rgba(184, 134, 11, 0.1);
}
```

## 🎬 Animationen & Transitions

### Standard Transitions
```css
--transition-fast: 150ms ease;
--transition-normal: 300ms ease;
--transition-slow: 500ms ease;
```

### Hover-Effekte
- Buttons: Transform translateY(-2px)
- Cards: Transform translateY(-4px)
- Links: Color-Transition mit Underline

### Animationen
```css
@keyframes goldPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
```

## 🌐 Responsive Design

### Breakpoints
```css
/* Mobile First Approach */
@media (min-width: 768px) { /* Tablet */ }
@media (min-width: 1024px) { /* Desktop */ }
@media (min-width: 1400px) { /* Large Desktop */ }
```

### Mobile Optimierungen
- Touch-freundliche Button-Größen (min. 44x44px)
- Vereinfachte Navigation (Hamburger Menu)
- Angepasste Schriftgrößen
- Stack-Layout für Cards

## ♿ Barrierefreiheit

### Kontrast
- Minimum Kontrast-Verhältnis: 4.5:1 (Normal Text)
- Large Text: 3:1
- Fokus-Indikatoren für alle interaktiven Elemente

### Keyboard Navigation
- Alle Elemente per Tab erreichbar
- Sichtbare Fokus-States
- Skip-Links für Hauptinhalt

### Screen Reader
- Semantisches HTML
- ARIA-Labels wo nötig
- Alt-Texte für Bilder

## 🎯 Best Practices

### DO's
✅ Konsistente Verwendung der Farbpalette
✅ Klare visuelle Hierarchie
✅ Ausreichende Abstände zwischen Elementen
✅ Progressive Enhancement
✅ Mobile-First Entwicklung

### DON'Ts
❌ Zu viele verschiedene Schriftgrößen
❌ Inkonsistente Abstände
❌ Zu kleine Touch-Targets
❌ Fehlende Hover/Focus-States
❌ Zu niedrige Kontraste

## 📦 CSS Variablen

```css
:root {
    /* Colors */
    --primary-gold: #B8860B;
    --primary-gold-light: #D4A76A;
    --primary-gold-dark: #8B6914;
    
    /* Spacing */
    --spacing-unit: 1rem;
    
    /* Typography */
    --font-primary: 'Montserrat', sans-serif;
    --font-secondary: 'Open Sans', sans-serif;
    
    /* Transitions */
    --transition-normal: 300ms ease;
    
    /* Shadows */
    --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 8px rgba(0,0,0,0.2);
    --shadow-lg: 0 8px 16px rgba(0,0,0,0.3);
}
```

## 🔧 Implementierung

### Laravel Blade Components
```blade
{{-- Button Component --}}
<x-button type="primary" size="lg">
    Jetzt anfragen
</x-button>

{{-- Card Component --}}
<x-card>
    <x-slot name="title">Card Title</x-slot>
    <x-slot name="content">Card content...</x-slot>
</x-card>
```

### CSS Klassen
```html
<!-- Primary Button -->
<button class="btn btn-primary">Button</button>

<!-- Card -->
<div class="card">
    <h3 class="card-title">Title</h3>
    <p class="card-content">Content</p>
</div>

<!-- Form -->
<form class="form">
    <div class="form-group">
        <label class="form-label">Label</label>
        <input class="form-input" type="text">
    </div>
</form>
```

## 📚 Ressourcen

- [Figma Design File](#)
- [Component Library](#)
- [Icon Set](#)
- [Brand Guidelines](#)

---

*Version 1.0.0 - Stand: August 2025*