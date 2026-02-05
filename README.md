# Artisan Scroll-Progress Navigation

A premium, performance-first WordPress plugin developed for **Heritage Oakwood Journals**. This plugin provides a minimalist, floating "Back to Top" navigation element with an integrated circular scroll-depth indicator.

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
* **Toggle Post Types**: Enable or disable the tracker for Products vs. Posts.
* **Brand Integration**: Change the primary color of the progress ring to match your brand palette.
* **Custom Iconry**: Upload a custom SVG logo or arrow for the button center via the WordPress Media Library.
* **Positioning**: Choose between Bottom-Right or Bottom-Left alignment.

## 📱 Responsive Design
The button features automatic resizing and repositioning for mobile devices. This ensures that the navigation does not obstruct "Add to Cart" sticky buttons or other mobile-specific ecommerce elements.

## 🧪 Technical Documentation
### Scroll-Tracking Logic
The progress ring calculates the current scroll position using a calculation of current scroll position relative to the total document height minus the viewport height. This percentage is then applied to the SVG `stroke-dashoffset` property to fill the circular border.

### Security
* All user inputs are sanitized using `sanitize_hex_color` and `esc_url_raw`.
* All frontend outputs are escaped using `esc_url` and `esc_attr` to prevent XSS vulnerabilities.

---
**Client:** Heritage Oakwood Journals
**Deliverable:** 1.1 Stable
