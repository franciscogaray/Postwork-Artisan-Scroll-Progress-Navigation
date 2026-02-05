# Artisan Scroll-Progress Navigation

A premium, performance-first WordPress plugin developed for **Heritage Oakwood Journals**. This plugin provides a minimalist, floating "Back to Top" navigation element with an integrated circular scroll-depth indicator to assist users on long-form product pages.

## 🚀 Performance & Architecture
* **Vanilla JavaScript**: Built with zero dependencies on jQuery to ensure a 0% impact on PageSpeed Insights scores.
* **SVG Graphics**: Uses a lightweight SVG path to render the progress ring, preventing layout shifts (CLS).
* **Smart Visibility**: The button remains hidden until a 400px scroll threshold is reached to maintain a clean UI.

## 🛠 Installation
1.  Download the plugin ZIP file.
2.  In your WordPress Dashboard, navigate to **Plugins > Add New > Upload Plugin**.
3.  Upload `artisan-scroll-progress.zip` and click **Activate**.
4.  Navigate to **Settings > Scroll Progress** to configure your brand aesthetics.

## ⚙️ Admin Customization Suite
The plugin includes a dedicated settings page allowing site owners to:
* **Toggle Post Types**: Enable or disable the tracker for specific post types like Products vs. Posts.
* **Brand Integration**: Change the primary color of the progress ring to match your brand palette.
* **Custom Iconry**: Upload a custom SVG logo or arrow for the button center via the WordPress Media Library.
* **Positioning**: Choose between Bottom-Right or Bottom-Left alignment.

## 📱 Responsive Design
The button features automatic resizing and repositioning for mobile devices. This ensures that the navigation does not obstruct "Add to Cart" sticky buttons common in ecommerce themes.

## 🧪 Technical Documentation

### Scroll-Tracking Logic
The plugin utilizes a high-performance scroll listener to calculate the user's vertical position relative to the total scrollable area. The logic follows this formula:

$$\text{Progress \%} = \left( \frac{\text{window.scrollY}}{\text{document.scrollHeight} - \text{window.innerHeight}} \right) \times 100$$

This percentage is mapped to the `stroke-dashoffset` of the circular SVG border, causing the ring to fill from 0% to 100% as the user reaches the bottom of the page.

### Function Overview
* `__construct()`: Initializes admin menus, settings, and front-end hooks.
* `settings_init()`: Registers security-focused settings for brand colors, positioning, and icon uploads.
* `enqueue_assets()`: Conditionally loads the lightweight CSS and vanilla JS only on authorized post types.
* `render_button()`: Outputs the SVG structure and icon container into the page footer.
* `updateScroll()` (JS): Calculates depth and toggles visibility classes based on the 400px threshold.

### Security & Compatibility
* **Sanitization**: All user inputs are sanitized using `sanitize_hex_color` and `esc_url_raw`.
* **Escaping**: All frontend outputs are escaped using `esc_url` and `esc_attr` to prevent XSS.
* **Browser Support**: Triggers a smooth scroll back to the top across Chrome, Firefox, Safari, and Edge.

---
**Client:** Heritage Oakwood Journals
**Deliverable:** 1.1 Stable
