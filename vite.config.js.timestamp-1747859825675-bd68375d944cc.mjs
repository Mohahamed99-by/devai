// vite.config.js
import { defineConfig } from "file:///C:/Users/lenovo/Desktop/devsai/devsai/node_modules/vite/dist/node/index.js";
import laravel from "file:///C:/Users/lenovo/Desktop/devsai/devsai/node_modules/laravel-vite-plugin/dist/index.js";
import tailwindcss from "file:///C:/Users/lenovo/Desktop/devsai/devsai/node_modules/@tailwindcss/vite/dist/index.mjs";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true
    }),
    tailwindcss({
      theme: {
        extend: {
          colors: {
            // Modern color palette
            primary: {
              50: "#eef2ff",
              100: "#e0e7ff",
              200: "#c7d2fe",
              300: "#a5b4fc",
              400: "#818cf8",
              500: "#6366f1",
              600: "#4f46e5",
              700: "#4338ca",
              800: "#3730a3",
              900: "#312e81",
              950: "#1e1b4b"
            },
            secondary: {
              50: "#fdf4ff",
              100: "#fae8ff",
              200: "#f5d0fe",
              300: "#f0abfc",
              400: "#e879f9",
              500: "#d946ef",
              600: "#c026d3",
              700: "#a21caf",
              800: "#86198f",
              900: "#701a75",
              950: "#4a044e"
            },
            accent: {
              50: "#f0f9ff",
              100: "#e0f2fe",
              200: "#bae6fd",
              300: "#7dd3fc",
              400: "#38bdf8",
              500: "#0ea5e9",
              600: "#0284c7",
              700: "#0369a1",
              800: "#075985",
              900: "#0c4a6e",
              950: "#082f49"
            },
            dark: {
              50: "#f8fafc",
              100: "#f1f5f9",
              200: "#e2e8f0",
              300: "#cbd5e1",
              400: "#94a3b8",
              500: "#64748b",
              600: "#475569",
              700: "#334155",
              800: "#1e293b",
              900: "#0f172a",
              950: "#020617"
            }
          },
          fontFamily: {
            sans: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
            display: ["Lexend", "ui-sans-serif", "system-ui", "sans-serif"],
            mono: ["JetBrains Mono", "ui-monospace", "monospace"]
          },
          animation: {
            "fade-in": "fadeIn 0.5s ease-in-out",
            "slide-up": "slideUp 0.5s ease-in-out",
            "slide-down": "slideDown 0.5s ease-in-out",
            "slide-in-right": "slideInRight 0.5s ease-in-out",
            "slide-in-left": "slideInLeft 0.5s ease-in-out",
            "bounce-subtle": "bounceSlight 2s infinite",
            "pulse-subtle": "pulseSlight 3s infinite",
            "float": "float 6s ease-in-out infinite",
            "shine": "shine 2s linear infinite"
          },
          keyframes: {
            fadeIn: {
              "0%": { opacity: "0" },
              "100%": { opacity: "1" }
            },
            slideUp: {
              "0%": { transform: "translateY(20px)", opacity: "0" },
              "100%": { transform: "translateY(0)", opacity: "1" }
            },
            slideDown: {
              "0%": { transform: "translateY(-20px)", opacity: "0" },
              "100%": { transform: "translateY(0)", opacity: "1" }
            },
            slideInRight: {
              "0%": { transform: "translateX(20px)", opacity: "0" },
              "100%": { transform: "translateX(0)", opacity: "1" }
            },
            slideInLeft: {
              "0%": { transform: "translateX(-20px)", opacity: "0" },
              "100%": { transform: "translateX(0)", opacity: "1" }
            },
            bounceSlight: {
              "0%, 100%": { transform: "translateY(0)" },
              "50%": { transform: "translateY(-10px)" }
            },
            pulseSlight: {
              "0%, 100%": { opacity: "1" },
              "50%": { opacity: "0.8" }
            },
            float: {
              "0%, 100%": { transform: "translateY(0)" },
              "50%": { transform: "translateY(-15px)" }
            },
            shine: {
              "0%": { backgroundPosition: "200% center" },
              "100%": { backgroundPosition: "-200% center" }
            }
          },
          boxShadow: {
            "soft": "0 2px 15px -3px rgba(0, 0, 0, 0.07), 0 10px 20px -2px rgba(0, 0, 0, 0.04)",
            "soft-xl": "0 20px 25px -5px rgba(0, 0, 0, 0.07), 0 10px 10px -5px rgba(0, 0, 0, 0.04)",
            "inner-soft": "inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)",
            "colored": "0 4px 14px 0 rgba(99, 102, 241, 0.3)"
          },
          backdropBlur: {
            "xs": "2px"
          },
          borderRadius: {
            "xl": "1rem",
            "2xl": "1.5rem",
            "3xl": "2rem"
          }
        }
      }
    })
  ]
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxsZW5vdm9cXFxcRGVza3RvcFxcXFxkZXZzYWlcXFxcZGV2c2FpXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxVc2Vyc1xcXFxsZW5vdm9cXFxcRGVza3RvcFxcXFxkZXZzYWlcXFxcZGV2c2FpXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9Vc2Vycy9sZW5vdm8vRGVza3RvcC9kZXZzYWkvZGV2c2FpL3ZpdGUuY29uZmlnLmpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgbGFyYXZlbCBmcm9tICdsYXJhdmVsLXZpdGUtcGx1Z2luJztcbmltcG9ydCB0YWlsd2luZGNzcyBmcm9tICdAdGFpbHdpbmRjc3Mvdml0ZSc7XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbJ3Jlc291cmNlcy9jc3MvYXBwLmNzcycsICdyZXNvdXJjZXMvanMvYXBwLmpzJ10sXG4gICAgICAgICAgICByZWZyZXNoOiB0cnVlLFxuICAgICAgICB9KSxcbiAgICAgICAgdGFpbHdpbmRjc3Moe1xuICB0aGVtZToge1xuICAgIGV4dGVuZDoge1xuICAgICAgY29sb3JzOiB7XG4gICAgICAgIC8vIE1vZGVybiBjb2xvciBwYWxldHRlXG4gICAgICAgIHByaW1hcnk6IHtcbiAgICAgICAgICA1MDogJyNlZWYyZmYnLFxuICAgICAgICAgIDEwMDogJyNlMGU3ZmYnLFxuICAgICAgICAgIDIwMDogJyNjN2QyZmUnLFxuICAgICAgICAgIDMwMDogJyNhNWI0ZmMnLFxuICAgICAgICAgIDQwMDogJyM4MThjZjgnLFxuICAgICAgICAgIDUwMDogJyM2MzY2ZjEnLFxuICAgICAgICAgIDYwMDogJyM0ZjQ2ZTUnLFxuICAgICAgICAgIDcwMDogJyM0MzM4Y2EnLFxuICAgICAgICAgIDgwMDogJyMzNzMwYTMnLFxuICAgICAgICAgIDkwMDogJyMzMTJlODEnLFxuICAgICAgICAgIDk1MDogJyMxZTFiNGInLFxuICAgICAgICB9LFxuICAgICAgICBzZWNvbmRhcnk6IHtcbiAgICAgICAgICA1MDogJyNmZGY0ZmYnLFxuICAgICAgICAgIDEwMDogJyNmYWU4ZmYnLFxuICAgICAgICAgIDIwMDogJyNmNWQwZmUnLFxuICAgICAgICAgIDMwMDogJyNmMGFiZmMnLFxuICAgICAgICAgIDQwMDogJyNlODc5ZjknLFxuICAgICAgICAgIDUwMDogJyNkOTQ2ZWYnLFxuICAgICAgICAgIDYwMDogJyNjMDI2ZDMnLFxuICAgICAgICAgIDcwMDogJyNhMjFjYWYnLFxuICAgICAgICAgIDgwMDogJyM4NjE5OGYnLFxuICAgICAgICAgIDkwMDogJyM3MDFhNzUnLFxuICAgICAgICAgIDk1MDogJyM0YTA0NGUnLFxuICAgICAgICB9LFxuICAgICAgICBhY2NlbnQ6IHtcbiAgICAgICAgICA1MDogJyNmMGY5ZmYnLFxuICAgICAgICAgIDEwMDogJyNlMGYyZmUnLFxuICAgICAgICAgIDIwMDogJyNiYWU2ZmQnLFxuICAgICAgICAgIDMwMDogJyM3ZGQzZmMnLFxuICAgICAgICAgIDQwMDogJyMzOGJkZjgnLFxuICAgICAgICAgIDUwMDogJyMwZWE1ZTknLFxuICAgICAgICAgIDYwMDogJyMwMjg0YzcnLFxuICAgICAgICAgIDcwMDogJyMwMzY5YTEnLFxuICAgICAgICAgIDgwMDogJyMwNzU5ODUnLFxuICAgICAgICAgIDkwMDogJyMwYzRhNmUnLFxuICAgICAgICAgIDk1MDogJyMwODJmNDknLFxuICAgICAgICB9LFxuICAgICAgICBkYXJrOiB7XG4gICAgICAgICAgNTA6ICcjZjhmYWZjJyxcbiAgICAgICAgICAxMDA6ICcjZjFmNWY5JyxcbiAgICAgICAgICAyMDA6ICcjZTJlOGYwJyxcbiAgICAgICAgICAzMDA6ICcjY2JkNWUxJyxcbiAgICAgICAgICA0MDA6ICcjOTRhM2I4JyxcbiAgICAgICAgICA1MDA6ICcjNjQ3NDhiJyxcbiAgICAgICAgICA2MDA6ICcjNDc1NTY5JyxcbiAgICAgICAgICA3MDA6ICcjMzM0MTU1JyxcbiAgICAgICAgICA4MDA6ICcjMWUyOTNiJyxcbiAgICAgICAgICA5MDA6ICcjMGYxNzJhJyxcbiAgICAgICAgICA5NTA6ICcjMDIwNjE3JyxcbiAgICAgICAgfSxcbiAgICAgIH0sXG4gICAgICBmb250RmFtaWx5OiB7XG4gICAgICAgIHNhbnM6IFsnSW50ZXInLCAndWktc2Fucy1zZXJpZicsICdzeXN0ZW0tdWknLCAnc2Fucy1zZXJpZiddLFxuICAgICAgICBkaXNwbGF5OiBbJ0xleGVuZCcsICd1aS1zYW5zLXNlcmlmJywgJ3N5c3RlbS11aScsICdzYW5zLXNlcmlmJ10sXG4gICAgICAgIG1vbm86IFsnSmV0QnJhaW5zIE1vbm8nLCAndWktbW9ub3NwYWNlJywgJ21vbm9zcGFjZSddLFxuICAgICAgfSxcbiAgICAgIGFuaW1hdGlvbjoge1xuICAgICAgICAnZmFkZS1pbic6ICdmYWRlSW4gMC41cyBlYXNlLWluLW91dCcsXG4gICAgICAgICdzbGlkZS11cCc6ICdzbGlkZVVwIDAuNXMgZWFzZS1pbi1vdXQnLFxuICAgICAgICAnc2xpZGUtZG93bic6ICdzbGlkZURvd24gMC41cyBlYXNlLWluLW91dCcsXG4gICAgICAgICdzbGlkZS1pbi1yaWdodCc6ICdzbGlkZUluUmlnaHQgMC41cyBlYXNlLWluLW91dCcsXG4gICAgICAgICdzbGlkZS1pbi1sZWZ0JzogJ3NsaWRlSW5MZWZ0IDAuNXMgZWFzZS1pbi1vdXQnLFxuICAgICAgICAnYm91bmNlLXN1YnRsZSc6ICdib3VuY2VTbGlnaHQgMnMgaW5maW5pdGUnLFxuICAgICAgICAncHVsc2Utc3VidGxlJzogJ3B1bHNlU2xpZ2h0IDNzIGluZmluaXRlJyxcbiAgICAgICAgJ2Zsb2F0JzogJ2Zsb2F0IDZzIGVhc2UtaW4tb3V0IGluZmluaXRlJyxcbiAgICAgICAgJ3NoaW5lJzogJ3NoaW5lIDJzIGxpbmVhciBpbmZpbml0ZScsXG4gICAgICB9LFxuICAgICAga2V5ZnJhbWVzOiB7XG4gICAgICAgIGZhZGVJbjoge1xuICAgICAgICAgICcwJSc6IHsgb3BhY2l0eTogJzAnIH0sXG4gICAgICAgICAgJzEwMCUnOiB7IG9wYWNpdHk6ICcxJyB9LFxuICAgICAgICB9LFxuICAgICAgICBzbGlkZVVwOiB7XG4gICAgICAgICAgJzAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVZKDIwcHgpJywgb3BhY2l0eTogJzAnIH0sXG4gICAgICAgICAgJzEwMCUnOiB7IHRyYW5zZm9ybTogJ3RyYW5zbGF0ZVkoMCknLCBvcGFjaXR5OiAnMScgfSxcbiAgICAgICAgfSxcbiAgICAgICAgc2xpZGVEb3duOiB7XG4gICAgICAgICAgJzAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVZKC0yMHB4KScsIG9wYWNpdHk6ICcwJyB9LFxuICAgICAgICAgICcxMDAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVZKDApJywgb3BhY2l0eTogJzEnIH0sXG4gICAgICAgIH0sXG4gICAgICAgIHNsaWRlSW5SaWdodDoge1xuICAgICAgICAgICcwJSc6IHsgdHJhbnNmb3JtOiAndHJhbnNsYXRlWCgyMHB4KScsIG9wYWNpdHk6ICcwJyB9LFxuICAgICAgICAgICcxMDAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVYKDApJywgb3BhY2l0eTogJzEnIH0sXG4gICAgICAgIH0sXG4gICAgICAgIHNsaWRlSW5MZWZ0OiB7XG4gICAgICAgICAgJzAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVYKC0yMHB4KScsIG9wYWNpdHk6ICcwJyB9LFxuICAgICAgICAgICcxMDAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVYKDApJywgb3BhY2l0eTogJzEnIH0sXG4gICAgICAgIH0sXG4gICAgICAgIGJvdW5jZVNsaWdodDoge1xuICAgICAgICAgICcwJSwgMTAwJSc6IHsgdHJhbnNmb3JtOiAndHJhbnNsYXRlWSgwKScgfSxcbiAgICAgICAgICAnNTAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVZKC0xMHB4KScgfSxcbiAgICAgICAgfSxcbiAgICAgICAgcHVsc2VTbGlnaHQ6IHtcbiAgICAgICAgICAnMCUsIDEwMCUnOiB7IG9wYWNpdHk6ICcxJyB9LFxuICAgICAgICAgICc1MCUnOiB7IG9wYWNpdHk6ICcwLjgnIH0sXG4gICAgICAgIH0sXG4gICAgICAgIGZsb2F0OiB7XG4gICAgICAgICAgJzAlLCAxMDAlJzogeyB0cmFuc2Zvcm06ICd0cmFuc2xhdGVZKDApJyB9LFxuICAgICAgICAgICc1MCUnOiB7IHRyYW5zZm9ybTogJ3RyYW5zbGF0ZVkoLTE1cHgpJyB9LFxuICAgICAgICB9LFxuICAgICAgICBzaGluZToge1xuICAgICAgICAgICcwJSc6IHsgYmFja2dyb3VuZFBvc2l0aW9uOiAnMjAwJSBjZW50ZXInIH0sXG4gICAgICAgICAgJzEwMCUnOiB7IGJhY2tncm91bmRQb3NpdGlvbjogJy0yMDAlIGNlbnRlcicgfSxcbiAgICAgICAgfSxcbiAgICAgIH0sXG4gICAgICBib3hTaGFkb3c6IHtcbiAgICAgICAgJ3NvZnQnOiAnMCAycHggMTVweCAtM3B4IHJnYmEoMCwgMCwgMCwgMC4wNyksIDAgMTBweCAyMHB4IC0ycHggcmdiYSgwLCAwLCAwLCAwLjA0KScsXG4gICAgICAgICdzb2Z0LXhsJzogJzAgMjBweCAyNXB4IC01cHggcmdiYSgwLCAwLCAwLCAwLjA3KSwgMCAxMHB4IDEwcHggLTVweCByZ2JhKDAsIDAsIDAsIDAuMDQpJyxcbiAgICAgICAgJ2lubmVyLXNvZnQnOiAnaW5zZXQgMCAycHggNHB4IDAgcmdiYSgwLCAwLCAwLCAwLjA2KScsXG4gICAgICAgICdjb2xvcmVkJzogJzAgNHB4IDE0cHggMCByZ2JhKDk5LCAxMDIsIDI0MSwgMC4zKScsXG4gICAgICB9LFxuICAgICAgYmFja2Ryb3BCbHVyOiB7XG4gICAgICAgICd4cyc6ICcycHgnLFxuICAgICAgfSxcbiAgICAgIGJvcmRlclJhZGl1czoge1xuICAgICAgICAneGwnOiAnMXJlbScsXG4gICAgICAgICcyeGwnOiAnMS41cmVtJyxcbiAgICAgICAgJzN4bCc6ICcycmVtJyxcbiAgICAgIH0sXG4gICAgfSxcbiAgfSwgICAgICAgIH0pLFxuICAgIF0sXG59KTtcbiJdLAogICJtYXBwaW5ncyI6ICI7QUFBNlMsU0FBUyxvQkFBb0I7QUFDMVUsT0FBTyxhQUFhO0FBQ3BCLE9BQU8saUJBQWlCO0FBRXhCLElBQU8sc0JBQVEsYUFBYTtBQUFBLEVBQ3hCLFNBQVM7QUFBQSxJQUNMLFFBQVE7QUFBQSxNQUNKLE9BQU8sQ0FBQyx5QkFBeUIscUJBQXFCO0FBQUEsTUFDdEQsU0FBUztBQUFBLElBQ2IsQ0FBQztBQUFBLElBQ0QsWUFBWTtBQUFBLE1BQ2xCLE9BQU87QUFBQSxRQUNMLFFBQVE7QUFBQSxVQUNOLFFBQVE7QUFBQTtBQUFBLFlBRU4sU0FBUztBQUFBLGNBQ1AsSUFBSTtBQUFBLGNBQ0osS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLGNBQ0wsS0FBSztBQUFBLFlBQ1A7QUFBQSxZQUNBLFdBQVc7QUFBQSxjQUNULElBQUk7QUFBQSxjQUNKLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxjQUNMLEtBQUs7QUFBQSxZQUNQO0FBQUEsWUFD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
