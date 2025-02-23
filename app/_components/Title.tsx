export default function Header({ label, crumbs }: { label: string; crumbs?: string[] }) {
  return (
    <div className="mb-4">
      <p className="flex gap-2 mb-2">
        {crumbs?.map((item: string, i: number) => (
          <span key={i}>{item}</span>
        ))}
      </p>

      <h1 className="text-3xl">{label}</h1>
    </div>
  );
}
