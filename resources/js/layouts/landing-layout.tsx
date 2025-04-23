import { Head } from "@inertiajs/react";
import { ReactNode } from "react";
import Header from "@/components/main/header";
import Footer from "@/components/main/footer";

interface LandingLayoutProps {
  children: ReactNode;
  title?: string;
}

export default function LandingLayout({ children, title = "Welcome to E-Store" }: LandingLayoutProps) {
  return (
    <div className="min-h-screen bg-white dark:bg-gray-950">
      <Head title={title} />
      <Header />
      <main>
        {children}
      </main>
      <Footer />
    </div>
  );
}
