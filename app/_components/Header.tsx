import { metadata } from "../layout";

export default function Header() {
  return (
    <header className="p-5 rounded-md bg-blue-700 mb-5">
      <h1 className="text-4xl">{metadata.title as string}</h1>
      <h2 className="text-2xl">{metadata.description}</h2>
    </header>
  );
}
