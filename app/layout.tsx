import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";
import Navigation from "./_components/Navigation";
import ModalProvider from "./_contexts/Modal";
import Header from "./_components/Header";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Comedy",
  description: "Stupid and cheap comedy",
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="en">
      <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      </head>

      <body className={`${geistSans.variable} ${geistMono.variable} antialiased`}>
        <ModalProvider>
          <div className="container mx-auto p-5">
            <Header />
            <Navigation />
            {children}
          </div>
        </ModalProvider>
      </body>
    </html>
  );
}
