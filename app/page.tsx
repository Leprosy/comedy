import Link from "next/link";
import Title from "./_components/Title";
import { DataItem } from "./types";

export const dynamic = "force-dynamic";

export default async function Home() {
  const data = await fetch(`${process.env.BASE_URL}api/list`);
  const items: DataItem[] = await data.json();

  return (
    <div>
      <Title label="List" />

      {items.map((item: DataItem) => (
        <div key={item.id} className="flex gap-2">
          <span>{item.id}</span>
          <Link className="text-blue-500 hover:underline" href={"/view/" + item.id}>
            {item.name}
          </Link>
        </div>
      ))}
    </div>
  );
}
