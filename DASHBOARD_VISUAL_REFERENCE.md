# Dashboard Component - Quick Visual Reference

## 🎨 Admin Dashboard Layout

```
┌─────────────────────────────────────────────────────────────────┐
│ HEADER                                                          │
│ [☰] Admin Panel > Dashboard    🕐 Time  🔔  🌙  👤 Admin ▾     │
└─────────────────────────────────────────────────────────────────┘
┌──────────┬─────────────────────────────────────────────────────┐
│ SIDEBAR  │ MAIN CONTENT                                        │
│          │                                                      │
│ [Logo]   │ ┌─ STATS CARDS (4 columns) ─────────────────────┐  │
│          │ │                                                 │  │
│ [Nav]    │ │ [👥 Users]  [🏠 Props]  [📝 Active]  [⏰ KYC]│  │
│ □ Dash   │ │  Blue        Green       Purple       Orange   │  │
│ □ Users  │ │  Gradient    Gradient    Gradient     Gradient │  │
│ □ Props  │ │  + Hover     + Hover     + Hover      + Hover  │  │
│ □ KYC    │ └─────────────────────────────────────────────────┘  │
│ □ Sets   │                                                      │
│          │ ┌─ QUICK ACTIONS ───────────────────────────────┐  │
│ [Toggle] │ │ [+ Property] [+ User] [Review KYC] [Reports] │  │
│          │ │  Blue Grad   Green     Orange       Purple    │  │
│          │ └─────────────────────────────────────────────────┘  │
│          │                                                      │
│          │ ┌─ RECENT PROPERTIES ───────────────────────────┐  │
│          │ │ Recent Properties              [View All →]   │  │
│          │ │ ┌────────────────────────────────────────────┐│  │
│          │ │ │ [Img] Property  Owner   Type  Price Status ││  │
│          │ │ │ [Img] Property  Owner   Type  Price Status ││  │
│          │ │ │ [Img] Property  Owner   Type  Price Status ││  │
│          │ │ └────────────────────────────────────────────┘│  │
│          │ └─────────────────────────────────────────────────┘  │
│          │                                                      │
│          │ ┌─ PENDING KYC ─────────────────────────────────┐  │
│          │ │ Pending KYC Verifications  [3]  [View All →] │  │
│          │ │ ┌──────────┐ ┌──────────┐ ┌──────────┐       │  │
│          │ │ │[👤] User │ │[👤] User │ │[👤] User │       │  │
│          │ │ │ID Type   │ │ID Type   │ │ID Type   │       │  │
│          │ │ │Submitted │ │Submitted │ │Submitted │       │  │
│          │ │ │[Review]  │ │[Review]  │ │[Review]  │       │  │
│          │ │ └──────────┘ └──────────┘ └──────────┘       │  │
│          │ └─────────────────────────────────────────────────┘  │
└──────────┴─────────────────────────────────────────────────────┘
```

---

## 🎨 Child Page Layout (e.g., KYC Index)

```
┌─────────────────────────────────────────────────────────────────┐
│ HEADER                                                          │
│ [☰] Admin Panel > KYC Verifications  🕐  🔔  🌙  👤 Admin ▾   │
│     └─ Breadcrumbs                                              │
│                                   [Filter ▾] [Export Report]    │
│                                   └─ Header Actions             │
└─────────────────────────────────────────────────────────────────┘
┌──────────┬─────────────────────────────────────────────────────┐
│ SIDEBAR  │ MAIN CONTENT                                        │
│          │                                                      │
│ [Logo]   │ ┌─ STATS OVERVIEW ──────────────────────────────┐  │
│          │ │ [⏰ Pending] [✓ Approved] [✗ Rejected] [Total]│  │
│ [Nav]    │ │  Orange       Green        Red          Blue   │  │
│ □ Dash   │ └─────────────────────────────────────────────────┘  │
│ ▶ Users  │                                                      │
│ □ Props  │ ┌─ KYC SUBMISSIONS ─────────────────────────────┐  │
│ □ KYC ★  │ │ KYC Submissions                               │  │
│ □ Sets   │ │                                                 │  │
│          │ │ ┌───────────────────────────────────────────┐  │  │
│ [Toggle] │ │ │ [👤] John Doe      johndoe@email.com     │  │  │
│          │ │ │ ID: Passport | Submitted: 2 hours ago    │  │  │
│          │ │ │ Status: [⏰ Pending]  [Review Details →] │  │  │
│          │ │ └───────────────────────────────────────────┘  │  │
│          │ │                                                 │  │
│          │ │ ┌───────────────────────────────────────────┐  │  │
│          │ │ │ [👤] Jane Smith    janesmith@email.com   │  │  │
│          │ │ │ ID: Driver Lic | Submitted: 5 hours ago  │  │  │
│          │ │ │ Status: [⏰ Pending]  [Review Details →] │  │  │
│          │ │ └───────────────────────────────────────────┘  │  │
│          │ │                                                 │  │
│          │ │ ─────────── Pagination ──────────────          │  │
│          │ └─────────────────────────────────────────────────┘  │
└──────────┴─────────────────────────────────────────────────────┘
```

---

## 🎨 Component Slot Structure

```blade
<x-app-dashboard title="..." subtitle="..." role="admin">
    
    <!-- SLOT 1: Breadcrumbs (appears in header) -->
    <x-slot:breadcrumbs>
        Admin Panel > Current Page
    </x-slot:breadcrumbs>
    
    <!-- SLOT 2: Header Actions (top right) -->
    <x-slot:headerActions>
        [Filter] [Export] [Add New]
    </x-slot:headerActions>
    
    <!-- SLOT 3: Navigation (sidebar menu) -->
    <x-slot:navigation>
        □ Dashboard
        □ Users
        □ Properties
        □ KYC ★
    </x-slot:navigation>
    
    <!-- SLOT 4: Profile Links (user dropdown) -->
    <x-slot:profileLinks>
        Profile | Settings | Logout
    </x-slot:profileLinks>
    
    <!-- SLOT 5: Notifications (bell dropdown) -->
    <x-slot:notifications>
        Notification 1
        Notification 2
    </x-slot:notifications>
    
    <!-- SLOT 6: Main Content (default slot) -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        Your page content here
    </div>
    
</x-app-dashboard>
```

---

## 🎨 Color Palette by Role

### Admin (Purple/Blue)
```
Primary:   #8B5CF6 (purple-500) → #3B82F6 (blue-700)
Accent:    #A78BFA (purple-400)
Hover:     Scale 1.05 + Shadow-lg
```

### Landlord (Blue)
```
Primary:   #3B82F6 (blue-500) → #1D4ED8 (blue-700)
Accent:    #60A5FA (blue-400)
Hover:     Scale 1.05 + Shadow-lg
```

### Tenant (Green)
```
Primary:   #10B981 (green-500) → #059669 (green-700)
Accent:    #14B8A6 (teal-400)
Hover:     Scale 1.05 + Shadow-lg
```

### Agent (Orange)
```
Primary:   #F97316 (orange-500) → #EA580C (orange-700)
Accent:    #FB923C (orange-400)
Hover:     Scale 1.05 + Shadow-lg
```

---

## 🎨 Common Card Patterns

### Stats Card
```blade
<div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
    <div class="flex items-center justify-between mb-4">
        <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
            [Icon]
        </div>
        <div class="text-right">
            <div class="text-sm font-medium opacity-90">Label</div>
            <div class="text-3xl font-bold">Value</div>
        </div>
    </div>
    <div class="flex items-center text-sm opacity-90">
        [Status indicator]
    </div>
</div>
```

### Action Button
```blade
<a href="#" class="flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-blue-600 text-white px-6 py-2 rounded-lg hover:from-purple-700 hover:to-blue-700 transition shadow-md hover:shadow-lg transform hover:scale-105">
    <svg class="w-5 h-5">...</svg>
    <span class="font-semibold">Action</span>
</a>
```

### Table Row
```blade
<tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 transition-all duration-200 group">
    <td class="py-4 px-6">
        <div class="flex items-center space-x-3">
            <img src="..." class="w-14 h-14 rounded-xl object-cover shadow-md group-hover:shadow-lg transition">
            <span class="font-semibold text-gray-900 group-hover:text-purple-700 transition">Name</span>
        </div>
    </td>
    <!-- More columns -->
</tr>
```

### Status Badge
```blade
<!-- Available -->
<span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-sm flex items-center w-fit">
    <span class="w-1.5 h-1.5 bg-white rounded-full mr-1.5 animate-pulse"></span>
    Available
</span>

<!-- Pending -->
<span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-orange-500 to-red-500 text-white shadow-sm animate-pulse">
    Pending
</span>

<!-- Approved -->
<span class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-sm">
    ✓ Approved
</span>
```

---

## 🎨 Animation Classes

### Hover Scale
```css
transform transition-all duration-300 hover:scale-105
```

### Pulse Animation
```css
animate-pulse
```

### Slide In (Alpine.js)
```html
x-transition
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 transform scale-90"
x-transition:enter-end="opacity-100 transform scale-100"
```

### Gradient Background
```css
bg-gradient-to-br from-purple-500 to-blue-700
```

### Shadow Elevation
```css
shadow-sm → shadow-md → shadow-lg → shadow-xl
hover:shadow-lg
```

---

## 📱 Responsive Breakpoints

```
Mobile:   < 768px  (Stack cards vertically, hamburger menu)
Tablet:   768px+   (2-column grid, collapsible sidebar)
Desktop:  1024px+  (4-column grid, full sidebar)
Wide:     1280px+  (Larger containers, more spacing)
```

---

## ✨ Key Design Principles

1. **Gradients**: Use `from-{color}-500 to-{color}-600` for depth
2. **Shadows**: Layer shadows for elevation (sm → md → lg on hover)
3. **Transitions**: Always include smooth transitions (duration-200/300)
4. **Hover States**: Scale + shadow for interactive elements
5. **Spacing**: Consistent gaps (gap-4, gap-6, gap-8)
6. **Borders**: Rounded corners (rounded-lg, rounded-xl)
7. **Typography**: Bold headings, clear hierarchy
8. **Icons**: Consistent size (w-5 h-5 for buttons, w-4 h-4 for inline)

---

**Quick Copy-Paste Templates:**
- See `DASHBOARD_COMPONENT_GUIDE.md` for full examples
- Check `admin/kyc/index-example.blade.php` for live implementation
- Reference `admin/dashboard.blade.php` for dashboard patterns

