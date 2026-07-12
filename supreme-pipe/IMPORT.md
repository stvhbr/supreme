# Supreme Steel Pipe — WordPress Import Guide

## Requirements

| Requirement | Version |
|---|---|
| WordPress | 6.4+ |
| PHP | 8.1+ |
| ACF Pro | 6.2+ |
| Rank Math SEO Pro | 3.0+ |
| Parent theme | GeneratePress (free) |

---

## Step 1 — Install & Activate Parent Theme

1. Go to **Appearance → Themes → Add New**
2. Search for **GeneratePress** and install it
3. Activate GeneratePress

---

## Step 2 — Install Plugins

Install and activate each plugin before proceeding:

- **Advanced Custom Fields Pro** — upload the .zip from your ACF license
- **Rank Math SEO Pro** — install via Rank Math dashboard
- **WP Rocket** (or LiteSpeed Cache) — for Core Web Vitals
- **WPForms** or **Gravity Forms** — for the quote/contact form
- **Redirection** — for 301 redirect management

---

## Step 3 — Install the Child Theme

1. Zip the `supreme-pipe/` folder
2. Go to **Appearance → Themes → Add New → Upload Theme**
3. Upload the zip and activate it
4. WordPress will automatically load the parent (GeneratePress) stylesheet

---

## Step 4 — Import ACF Field Groups

The `acf-json/` folder in the theme contains all field group definitions.
ACF Pro will auto-load them on activation — no manual import needed.

To verify: go to **Custom Fields → Field Groups** — you should see:

- Product Fields
- Brand Fields
- Application Fields
- Resource Fields
- Location Fields
- FAQ Fields
- Homepage Options
- Global CTA Options
- Company Info Options
- Footer Options
- SEO Defaults

---

## Step 5 — Configure Rank Math

1. Go to **Rank Math → Setup Wizard** and complete the wizard
2. Set **Business Type** to "Local Business / Organization"
3. Enter the company details (name, URL, logo)
4. Enable **Breadcrumbs**, **FAQ Schema**, **Product Schema**
5. Go to **Rank Math → Sitemap** → enable all CPTs

---

## Step 6 — Set Up the Quote Form

1. Create a new form in WPForms or Gravity Forms with fields:
   - Name, Company, Phone, Email
   - Product Interest (dropdown)
   - Quantity / Project Details (textarea)
   - Submit / Captcha
2. Note the Form ID
3. Go to **Site Settings → Quote Form** and enter the Form ID

---

## Step 7 — Populate Site Settings (ACF Options)

Navigate to each options page under the **Site Settings** admin menu:

### Homepage
- Upload hero background image (1280×600px)
- Fill in hero headline and sub-headline
- Add 4 stat items (e.g. "30+ Years", "500+ Products")
- Add "Who We Are" content
- Upload certification logos

### Global CTA
- Headline: "Ready to Start Your Next Project?"
- Primary button: "Request a Quote" → `/contact/`
- Upload brochure PDF

### Company Info
- Company name, tagline, phone, email, head office address
- Social media URLs (Facebook, TikTok, Instagram, LinkedIn)

### Footer
- Footer tagline
- Copyright text

### SEO Defaults
- Upload default OG image (1200×630px)
- Upload schema logo (square PNG)

---

## Step 8 — Create WordPress Pages

Create the following pages and assign their templates:

| Page Title | Slug | Template |
|---|---|---|
| Home | / | (Front Page — set in Settings → Reading) |
| Contact | /contact | Contact Page |
| Privacy Policy | /privacy-policy | Default |
| Thank You | /thank-you | Default (no-index in Rank Math) |

For landing pages (PPC):

| Page Title | Slug | Template |
|---|---|---|
| Galvanized Iron Pipe | /lp/galvanized-iron-pipe | Landing Page (No Nav/Footer) |
| Download Catalogue | /lp/catalogue | Landing Page (No Nav/Footer) |

---

## Step 9 — Add CPT Content

### Products (7 posts, post type: `product`)

| Post Title | Slug | Eyebrow | Material Taxonomy |
|---|---|---|---|
| Heavy Gauge Steel Pipe | heavy-gauge-steel-pipe | Heavy Gauge | Black Iron (BI), Galvanized Iron (GI) |
| Light Gauge Steel Pipe | light-gauge-steel-pipe | Light Gauge | Black Iron (BI), Galvanized Iron (GI) |
| Fire Sprinkler Pipe | fire-sprinkler-pipe | Fire Sprinkler | Black Iron (BI) |
| Structural & Fence Tube | structural-fence-tube | Structural | Structural Steel |
| Spiral Pipe (SSAW) | spiral-pipe-ssaw | Spiral | Structural Steel |
| LSAW Pipe | lsaw-pipe | LSAW | Structural Steel |
| Victaulic Fittings | victaulic-fittings | Fittings | — |

### Brands (6 posts, post type: `brand`)

| Post Title | Slug |
|---|---|
| Supreme Steel Pipe | supreme-steel-pipe |
| Superior Pipe | superior-pipe |
| Tri-R Pipe | tri-r-pipe |
| STRUX Steel Tube | strux-steel-tube |
| Supreme Red | supreme-red |
| Victaulic | victaulic |

### Applications (7 posts, post type: `application`)

Architectural, Industrial, Sanitary, Liquid & Gas, Structural, Civil Infrastructure, Fire Protection

### Locations (6+ posts, post type: `location`)

Add each dealer/distributor as a Location post. Set the `sort_order` field: Main Office = 1, others = 10+.

---

## Step 10 — Set Reading Settings

1. Go to **Settings → Reading**
2. Set "Your homepage displays" to **A static page**
3. Select the **Home** page as your homepage

---

## Step 11 — Flush Permalinks

Go to **Settings → Permalinks** and click **Save Changes** (no changes needed — just flush).

---

## Step 12 — Submit Sitemap to Google

1. Go to **Rank Math → Sitemap** and copy the sitemap URL
2. Open Google Search Console
3. Go to **Sitemaps** and submit the sitemap URL

---

## SEO Checklist Before Launch

- [ ] All product pages have unique meta title + description
- [ ] All images have alt text (set in ACF image fields)
- [ ] Breadcrumbs showing correctly on all CPT singles
- [ ] Rich Results Test passes for Product, FAQ, LocalBusiness schemas
- [ ] Landing pages (/lp/*) set to no-index in Rank Math
- [ ] Thank-you page set to no-index
- [ ] 301 redirect map entered in Redirection plugin
- [ ] OG image (1200×630px) set for homepage and key CPT posts
- [ ] Core Web Vitals: LCP < 2.5s (check PageSpeed Insights)
- [ ] Mobile nav works correctly on iOS Safari and Android Chrome
