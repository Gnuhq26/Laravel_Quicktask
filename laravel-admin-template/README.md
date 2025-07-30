# Laravel Admin Template

A simple Bootstrap-based admin template for Laravel applications.

## Features

- **Bootstrap 5** integration
- **Responsive design** with mobile-first approach
- **SCSS support** with custom variables
- **JavaScript functionality** for admin panels
- **Laravel integration** ready

## Installation

```bash
npm install ./laravel-admin-template
```

## Usage

### In your Laravel app:

1. **Import SCSS:**
```scss
@import "laravel-admin-template/src/admin.scss";
```

2. **Import JavaScript:**
```javascript
import AdminApp from 'laravel-admin-template/src/admin.js';
```

3. **Use in Vite config:**
```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/admin.js'
            ],
        }),
    ],
});
```

## Components

- **Admin Sidebar** - Responsive navigation
- **Admin Header** - Top navigation bar
- **Admin Content** - Main content area
- **Cards** - Styled Bootstrap cards
- **Tables** - Enhanced table styles
- **Forms** - Custom form styling

## Customization

You can customize the template by overriding SCSS variables:

```scss
$primary-color: #your-color;
$secondary-color: #your-color;
```

## License

MIT 