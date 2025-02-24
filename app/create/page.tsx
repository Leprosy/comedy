"use client";

import { useContext, useRef, useState } from "react";
import { SlideData } from "../api/list/route";
import { Input, InputValidators } from "../_components/Input";
import { ModalContext } from "../_contexts/Modal";

export default function Home() {
  const [slides, setSlides] = useState<SlideData[]>([]);
  const [name, setName] = useState<string>("");
  const nameRef = useRef(null);
  const data = useContext(ModalContext);

  const addSlide = () => {
    const slide: SlideData = { img: "", caption: "", time: 1000 };
    setSlides([...slides, slide]);
  };

  const changeSlide = (i: number, data: SlideData) => {
    setSlides(slides.map((item: SlideData, j: number) => (j != i ? item : data)));
  };

  const saveData = () => {
    console.log("Saving", { name, slides });
  };

  return (
    <div>
      <h1>Create</h1>

      <Input
        name="name"
        ref={nameRef}
        value={name}
        onChange={(ev) => setName(ev.target.value)}
        placeholder="Enter some crap here..."
        label="Name of the comedy"
        validators={[InputValidators.notEmpty("Value cannot be empty")]}
      />

      <button onClick={saveData}>Save data</button>
      <hr />
      <button onClick={() => addSlide()} className="mb-5">
        Add Slide
      </button>
      {slides.map((slide: SlideData, i: number) => (
        <SlideForm slide={slide} key={i} index={i} onChange={changeSlide} />
      ))}
      <hr />
      <button onClick={() => data.setVisible(!data.visible)}>Picker</button>
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
