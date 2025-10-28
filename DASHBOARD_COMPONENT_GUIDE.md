# Dashboard Component Usage Guide

## Overview
The `app-dashboard` component provides a consistent, modern UI/UX across all admin panel pages. It includes sidebar navigation, header with actions, breadcrumbs, and responsive design with Alpine.js interactivity.

## Component Location
`resources/views/components/app-dashboard.blade.php`

---

## Basic Usage

```blade
<x-app-dashboard 
    title="Page Title" 
    subtitle="Page description or welcome message" 
    role="admin">
    
    <!-- Your page content here -->
    
</x-app-dashboard>
```

---

## Available Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | string | 'Dashboard' | Page title displayed in header |
| `subtitle` | string | '' | Subtitle/description text |
| `role` | string | 'user' | User role for theme colors (`admin`, `landlord`, `tenant`, `agent`) |

---

## Available Slots

### 1. **Navigation Slot** (`$navigation`)
Custom sidebar menu items. Must be placed in the sidebar navigation area.

```blade
<x-slot:navigation>
    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-white bg-purple-400 bg-opacity-20 rounded-lg">
        <svg class="w-5 h-5">...</svg>
        <span>Dashboard</span>
    </a>
    <!-- More menu items -->
</x-slot:navigation>
```

### 2. **Breadcrumbs Slot** (`$breadcrumbs`)
Navigation trail for user orientation.

```blade
<x-slot:breadcrumbs>
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                    <svg class="w-4 h-4 mr-2">...</svg>
                    Admin Panel
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400">...</svg>
                    <span class="ml-1 text-sm font-medium text-purple-600">Current Page</span>
                </div>
            </li>
        </ol>
    </nav>
</x-slot:breadcrumbs>
```

### 3. **Header Actions Slot** (`$headerActions`)
Page-specific action buttons in the header.

```blade
<x-slot:headerActions>
    <div class="flex items-center space-x-3">
        <button class="flex items-center space-x-2 bg-white border border-gray-300 px-4 py-2 rounded-lg">
            <svg class="w-5 h-5">...</svg>
            <span>Filter</span>
        </button>
        
        <a href="{{ route('admin.something.create') }}" class="flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg">
            <svg class="w-5 h-5">...</svg>
            <span>Add New</span>
        </a>
    </div>
</x-slot:headerActions>
```

### 4. **Profile Links Slot** (`$profileLinks`)
Custom dropdown menu items in the user profile dropdown.

```blade
<x-slot:profileLinks>
    <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        Profile Settings
    </a>
    <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        System Settings
    </a>
</x-slot:profileLinks>
```

### 5. **Notifications Slot** (`$notifications`)
Custom notification items in the notifications dropdown.

```blade
<x-slot:notifications>
    <a href="#" class="flex px-4 py-3 hover:bg-gray-50 border-b">
        <div class="flex-1">
            <p class="text-sm font-medium text-gray-900">New notification</p>
            <p class="text-xs text-gray-500">2 minutes ago</p>
        </div>
    </a>
</x-slot:notifications>
```

### 6. **Main Content Slot** (default `$slot`)
Your page content goes here.

```blade
<x-app-dashboard title="My Page" role="admin">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- Your content -->
    </div>
</x-app-dashboard>
```

---

## Role-Based Theming

The component automatically applies theme colors based on the `role` prop:

| Role | Primary Color | Secondary Color | Portal Text |
|------|---------------|-----------------|-------------|
| `admin` | Purple (#8B5CF6) | Blue (#3B82F6) | Admin Portal |
| `landlord` | Blue (#3B82F6) | Blue (#1D4ED8) | Landlord Portal |
| `tenant` | Green (#10B981) | Green (#059669) | Tenant Portal |
| `agent` | Orange (#F97316) | Orange (#EA580C) | Agent Portal |
| `user` | Gray (#6B7280) | Gray (#4B5563) | User Portal |

---

## Complete Example: List Page with All Features

```blade
<x-app-dashboard 
    title="All Properties" 
    subtitle="Manage and monitor all properties in the system" 
    role="admin">

    {{-- Breadcrumbs --}}
    <x-slot:breadcrumbs>
        <nav class="flex">
            <ol class="inline-flex items-center space-x-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-700 hover:text-purple-600">
                        Admin Panel
                    </a>
                </li>
                <li>
                    <span class="mx-2 text-gray-400">/</span>
                    <span class="text-sm text-purple-600">All Properties</span>
                </li>
            </ol>
        </nav>
    </x-slot:breadcrumbs>

    {{-- Header Actions --}}
    <x-slot:headerActions>
        <div class="flex items-center space-x-3">
            <button class="bg-white border px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('admin.properties.create') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg">
                Add Property
            </a>
        </div>
    </x-slot:headerActions>

    {{-- Main Content --}}
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-bold mb-4">Properties List</h3>
        <!-- Your table/grid/content here -->
    </div>
    
</x-app-dashboard>
```

---

## Features Included

### ✅ Responsive Sidebar
- Collapsible sidebar (toggles between 256px and 80px)
- Mobile-friendly hamburger menu
- Smooth transitions with Alpine.js

### ✅ Header Components
- Live clock (updates every second)
- Notifications dropdown
- Theme toggle (light/dark mode ready)
- User profile dropdown
- Breadcrumbs support
- Page-specific action buttons

### ✅ Interactive Elements
- Sidebar toggle with state persistence
- Dropdown menus (notifications, profile, user menu)
- Smooth animations and transitions
- Hover effects throughout

### ✅ Accessibility
- ARIA labels for screen readers
- Semantic HTML structure
- Keyboard navigation support

---

## Best Practices

1. **Always specify the role** - Ensures correct theme colors
2. **Use breadcrumbs on child pages** - Improves navigation UX
3. **Add relevant header actions** - Common actions should be easily accessible
4. **Keep content organized** - Use cards, sections, and proper spacing
5. **Maintain consistency** - Use the same design patterns across all pages

---

## Example Pages

See these examples for implementation patterns:
- `resources/views/admin/dashboard.blade.php` - Main dashboard with stats and tables
- `resources/views/admin/kyc/index-example.blade.php` - List page with breadcrumbs and actions
- `resources/views/tenant/dashboard.blade.php` - Tenant portal with search section
- `resources/views/agent/dashboard.blade.php` - Agent portal with quick actions
- `resources/views/landlord/dashboard.blade.php` - Landlord portal with property stats

---

## Tips for Extending

### Adding Custom Styles
The component uses Tailwind CSS. Add custom classes directly:

```blade
<x-app-dashboard title="My Page" role="admin">
    <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl shadow-lg p-8">
        <!-- Custom styled content -->
    </div>
</x-app-dashboard>
```

### Adding Alpine.js Interactivity
Use Alpine.js directives for dynamic behavior:

```blade
<div x-data="{ open: false }">
    <button @click="open = !open">Toggle</button>
    <div x-show="open" x-transition>Content</div>
</div>
```

### Creating Reusable Page Sections
Extract common patterns into Blade components:

```bash
php artisan make:component StatsCard
```

---

## Troubleshooting

### Sidebar not showing
- Ensure `$navigation` slot is populated
- Check that role is valid (`admin`, `landlord`, `tenant`, `agent`)

### Breadcrumbs not appearing
- Make sure `$breadcrumbs` slot is provided
- Verify the HTML structure matches the example

### Theme colors wrong
- Check the `role` prop value
- Ensure role exists in `$roleColors` array in component

### Alpine.js not working
- Verify Alpine.js is loaded in layout
- Check browser console for JavaScript errors
- Ensure `x-data` directives are properly closed

---

## Support

For issues or questions:
1. Check the example pages in `resources/views/`
2. Review the component code in `resources/views/components/app-dashboard.blade.php`
3. Verify Tailwind CSS and Alpine.js are properly configured

---

**Last Updated:** {{ now()->format('F d, Y') }}
