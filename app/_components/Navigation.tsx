"use client";

import Link from "next/link";
import { usePathname } from "next/navigation";

export default function Navigation() {
  const path = usePathname();

  return (
    <nav className="flex justify-center gap-2 bg-blue-950 rounded-md mb-5 p-5">
      <Link href={"/"} className={`${path == "/" ? "bg-blue-500" : "bg-blue-800"} rounded-md px-5 py-2`}>
        List
      </Link>
      <Link href={"/create"} className={`${path == "/create" ? "bg-blue-500" : "bg-blue-800"} rounded-md  px-5 py-2`}>
        Create
      </Link>
    </nav>
  );
}
