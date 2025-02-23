"use client";

import { useRef, useState } from "react";
import { SlideData } from "../api/list/route";
import { Input, InputFilters, InputValidators } from "../_components/Input";

export default function Home() {
  const [slides, setSlides] = useState<SlideData[]>([]);
  const [caption, setCaption] = useState<string>("");

  const addSlide = () => {
    const slide: SlideData = { img: "", caption: "", time: 1000 };
    setSlides([...slides, slide]);
  };

  const changeSlide = (i: number, data: SlideData) => {
    setSlides(slides.map((item: SlideData, j: number) => (j != i ? item : data)));
  };

  const saveData = () => {
    console.log("Saving", { caption, slides });
  };

  return (
    <div>
      <h1>Create</h1>

      <Input
        placeholder="Enter some crap here..."
        label="Test Input"
        validators={[InputValidators.notEmpty("Value cannot be empty")]}
      />
      <Input
        placeholder="Enter some crap here..."
        label="Custom validator Input(value cannot be 'oaw'), trim filter"
        filters={InputFilters.trim}
        validators={[(value) => (value === "oaw" ? "Error: Value cannot be OAW" : null)]}
      />
      <Input
        placeholder="Enter some crap here..."
        label="Filter to upper case, 3-10 chars length validator Input"
        filters={InputFilters.toUpper}
        validators={[InputValidators.length("Input must be [3-10] chars", { min: 3, max: 10 })]}
      />
      <Input
        placeholder="Enter some crap here..."
        label="At least 8 characters"
        validators={[InputValidators.length("Input must be at least 8 chars", { min: 8 })]}
      />
      <Input
        placeholder="Enter some crap here..."
        label="Max 8 characters"
        validators={[InputValidators.length("Input must be less than 9 chars", { max: 8 })]}
      />
      <Input
        placeholder="More crap here..."
        label="Non empty number"
        validators={[
          InputValidators.isNumber("Value must be a number"),
          InputValidators.notEmpty("Value cannot be empty for god's sake"),
        ]}
      />

      <hr />

      <label className="block mb-5">
        Name <input placeholder="Enter title..." value={caption} onChange={(ev) => setCaption(ev.target.value)}></input>
      </label>
      <button onClick={() => saveData()}>Save data</button>
      <hr />

      <button onClick={() => addSlide()} className="mb-5">
        Add Slide
      </button>

      {slides.map((slide: SlideData, i: number) => (
        <SlideForm slide={slide} key={i} index={i} onChange={changeSlide} />
      ))}
    </div>
  );
}

function SlideForm({
  slide,
  index,
  onChange,
}: {
  slide: SlideData;
  index: number;
  onChange: (i: number, data: SlideData) => void;
}) {
  const caption = useRef<HTMLInputElement>(null);
  const img = useRef<HTMLInputElement>(null);
  const time = useRef<HTMLInputElement>(null);

  const changeSlide = () => {
    onChange(index, { caption: caption.current!.value, img: img.current!.value, time: parseInt(time.current!.value) });
  };

  return (
    <div>
      <label className="block mb-5">
        Caption <input ref={caption} placeholder="Enter caption..." onChange={changeSlide} value={slide.caption} />
      </label>
      <label className="block mb-5">
        Image <input ref={img} placeholder="Select image..." onChange={changeSlide} value={slide.img} />
      </label>
      <label className="block mb-5">
        Duration
        <input
          ref={time}
          type="range"
          step="500"
          min="1000"
          max="10000"
          placeholder="Enter duration..."
          onChange={changeSlide}
          value={slide.time}
        />
        {slide.time / 1000}s
      </label>
    </div>
  );
}
